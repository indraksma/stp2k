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
        return view('auth.login');
    }
});

// Route::get('login', [SsoController::class, 'showForm'])->name('login');
Route::get('sso', [SsoController::class, 'sso']);
Route::get('ssocek', [SsoController::class, 'ssocek'])->name('ssocek');
Route::get('ssoout', [SsoController::class, 'logout'])->name('ssoout');
// Route::get('logout', [SsoController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('siswa', App\Http\Livewire\Siswa::class)->name('siswa');
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

// Example
Route::group(['middleware' => ['auth', 'role:admin|moderator|user'], 'prefix' => 'example'], function () {
    Route::get('crud', App\Http\Livewire\Example\CRUDLivewire::class)->name('example.crud');
});
