<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SsoController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return view('auth.loginsso');
    }
});

Route::get('homesiswa', App\Http\Livewire\Home\Siswa::class)->name('homesiswa');

Route::get('login', [SsoController::class, 'showForm'])->name('login');
Route::get('sso', [SsoController::class, 'sso']);
Route::get('ssocek', [SsoController::class, 'ssocek'])->name('ssocek');
Route::get('ssoout', [SsoController::class, 'logout'])->name('ssoout');
Route::get('logout', [SsoController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('siswa', App\Http\Livewire\Siswa::class)->name('siswa');
    Route::get('poin', App\Http\Livewire\Poin::class)->name('poin');
    Route::get('addpoin', App\Http\Livewire\AddPoin::class)->name('addpoin');
    Route::get('editpoin/{id}', App\Http\Livewire\EditPoin::class)->name('editpoin');
    Route::get('datapelanggaran', App\Http\Livewire\DataPelanggaran::class)->name('datapelanggaran');
    Route::get('kodepelanggaran', App\Http\Livewire\KodePelanggaran::class)->name('kodepelanggaran');
});
Route::middleware(['auth', 'role:admin|kesiswaan'])->group(function () {
    Route::get('penguranganpoin', App\Http\Livewire\PenguranganPoin::class)->name('penguranganpoin');
    Route::get('kenaikankelas', App\Http\Livewire\KenaikanKelas::class)->name('kenaikankelas');
    Route::get('pengaduan', App\Http\Livewire\Pengaduan::class)->name('pengaduan');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('users', App\Http\Livewire\Setting\User::class)->name('users');
    //Route::post('import-user', [UserController::class, 'import'])->name('import-user');
    Route::get('ta', App\Http\Livewire\Setting\TahunAjaran::class)->name('ta');
    Route::get('jurusan', App\Http\Livewire\Setting\Jurusan::class)->name('jurusan');
    Route::get('kelas', App\Http\Livewire\Setting\Kelas::class)->name('kelas');
    Route::get('pelanggaran', App\Http\Livewire\Setting\Pelanggaran::class)->name('pelanggaran');
});

// Home
Route::group(['middleware' => ['auth'], 'prefix' => 'home'], function () {
    Route::get('/', App\Http\Livewire\Home\HomeLivewire::class)->name('home');
});
