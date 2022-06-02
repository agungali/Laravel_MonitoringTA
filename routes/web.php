<?php

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
    return view('welcome');
});
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');
    Route::get('/register', function () {
        return view('auth/register');
    })->name('register');
});
Route::group(['middleware' => ['auth', 'role:dosen']], function () {
    Route::get('/home', function () {
        return view('home');
    });
});
Route::group(['middleware' => ['auth', 'role:mahasiswa']], function () {
    Route::get('/mahasiswa', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::get('/mahasiswa/create', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'create'])->name('create');
    Route::post('/mahasiswa/createdata', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'createdata'])->name('createdata');
});
