<?php

use App\Http\Controllers\AplikasiController;
use App\Http\Controllers\AuthAdmin\LoginAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/internal', [LoginAdminController::class, 'index'])->name('internal');
Route::post('/login-internal', [LoginAdminController::class, 'login'])->name('login-internal');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/end', [LoginAdminController::class, 'logout'])->name('end');
    
    Route::resource('/aplikasi', 'App\Http\Controllers\AplikasiController');
    // Route::get('/aplikasi', [AplikasiController::class, 'index'])->name('aplikasi');
});

