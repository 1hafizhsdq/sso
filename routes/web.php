<?php

use App\Http\Controllers\AplikasiController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\AuthAdmin\LoginAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserAdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});
Route::get('/coba', function () {
    return view('auth.logingoogle');
});

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/internal', [LoginAdminController::class, 'index'])->name('internal');
Route::post('/login-internal', [LoginAdminController::class, 'login'])->name('login-internal');

Route::get('forget-password', [ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
Route::post('forget-password', [ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
Route::post('reset-password', [ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/update-akun', [HomeController::class, 'updateAkun'])->name('update-akun');
    Route::post('/edit-username', [HomeController::class, 'editUsername'])->name('edit-username');
    Route::post('/edit-password', [HomeController::class, 'editPassword'])->name('edit-password');
});

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/end', [LoginAdminController::class, 'logout'])->name('end');
    
    Route::resource('/aplikasi', 'App\Http\Controllers\AplikasiController');
    Route::resource('/useradmin', UserAdminController::class);
    
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai');
    Route::get('/pns-skpd/{skpd}', [PegawaiController::class, 'pnsBySkpd'])->name('pns-skpd');
    Route::get('/reset-pegawai/{nip}', [PegawaiController::class, 'reset'])->name('reset-pegawai');

    Route::get('/update-akun-admin', [DashboardController::class, 'updateAkun'])->name('update-akun-admin');
    Route::post('/edit-username-admin', [DashboardController::class, 'editUsername'])->name('edit-username-admin');
    Route::post('/edit-password-admin', [DashboardController::class, 'editPassword'])->name('edit-password-admin');
});

