<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SsoController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function sso(Request $request)
    {

        $exodus = date("YwmldFn");
        $secret = "20mmIx" . $exodus . "uXciG4JH";
        $method = "AES-128-ECB";
        if (strlen($_SERVER['QUERY_STRING']) > 0) {



            $qstrx = $_SERVER['QUERY_STRING'];
            $qstr = openssl_decrypt($qstrx, $method, $secret);
            $arr = unserialize(urldecode($qstr));

            isset($arr['session']) or header("Location: /sso/");
            $sid = $arr['session'];
            isset($arr['email']) or die;
            $email = $arr['email'];
            isset($arr['identity']) or die;
            $nuptk = $arr['identity'];

            $user_id = User::where('identity', $nuptk)->value('id');
            if (Auth::loginUsingId($user_id, true)) {
                return redirect()->route('home');
            } else {
                $user_id = User::where('email', $email)->value('id');
                if (Auth::loginUsingId($user_id, true)) {
                    return redirect()->route('home');
                } else {
                    return redirect()->route('login')->with('message', 'User tidak terdaftar dalam SIPOIN, silahkan hubungi admin kesiswaan.');
                }
            }
        } else {
?>
            <script type="text/javascript">
                <!--
                window.location = "https://user.smkn1bawang.sch.id/sso/link/sipoin.smkn1bawang.sch.id";
                //
                -->
            </script>
        <?php

        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        ?>
        <script type="text/javascript">
            // Javascript URL redirection
            <?php
            if (strlen($_SERVER['QUERY_STRING']) > 0) {

            ?>
                window.location.replace("https://sipoin.smkn1bawang.sch.id/sso?<?php echo $_SERVER['QUERY_STRING']; ?>");
            <?php

            } else {
            ?>
                window.location.replace("https://user.smkn1bawang.sch.id/logout");
            <?php
            }
            ?>
        </script>
<?php
    }

    public function ssocek(Request $request)
    {
        $exodus = date("YwmldFn");
        $secret = "20mmIx" . $exodus . "uXciG4JH";
        $method = "AES-128-ECB";

        $rahasia = "ebdce3a7da1a048a859f3e0202db526c";
        $kunci = "SD9zDxRih5sHAv076MfE";
        $sso_server = "https://user.smkn1bawang.sch.id/sso";
        $domain = "sipoin.smkn1bawang.sch.id";
        $sso_client = "https://" . $domain . "/sso";
        $sso_referer = $domain . "/sso";
        $arr = array(
            'domain' => $domain,
            'rahasia' => $rahasia,
            'kunci' => $kunci,
            'service' => "$sso_client",
            'referer' => "$sso_referer",
            'session' => session_id()
        );

        $str = urlencode(serialize($arr));
        $str = openssl_encrypt($str, $method, $secret);

        header("Location: $sso_server/?" . $str);
        die;
    }

    public function showForm()
    {
        return view('auth.loginsso');
    }
}
