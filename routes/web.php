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
Route::get('/register', function () {
    return view('auth/register');
})->name('register');
Route::get('/admin/daftardosen', [App\Http\Controllers\Admin\AdminController::class, 'getdosen'])->name('getdosen');

Auth::routes();

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');
    Route::get('/dosen/register', [App\Http\Controllers\Auth\RegisterDosenController::class, 'registerdosen'])->name('registerdosen');
    Route::post('/dosen/adddosen', [App\Http\Controllers\Auth\RegisterDosenController::class, 'adddosen'])->name('adddosen');
    //route update data data mahasiswa
    Route::get('/mahasiswa/edit/{id}', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'edit'])->name('edit');
    Route::put('/mahasiswa/update/{id}', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'update'])->name('update');
    Route::get('/mahasiswa/delete/{id}', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'delete'])->name('delete');
    Route::get('/mahasiswa/detail/{id}', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'detail'])->name('detail');
    
});


Route::group(['middleware' => ['auth', 'role:dosen']], function () {
    Route::get('/dosen', [App\Http\Controllers\Dosen\DosenController::class, 'index'])->name('dosen');
    Route::get('/mahasiswa/detail/{id}', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'detail'])->name('detail');
    Route::post('/mahasiswa/uploadttd', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'proses_uploadbukti'])->name('proses_uploadbukti');
});


Route::group(['middleware' => ['auth', 'role:mahasiswa']], function () {
    Route::get('/mahasiswa', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::get('/mahasiswa/create', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'create'])->name('create');
    Route::post('/mahasiswa/createdata', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'createdata'])->name('createdata');
    Route::post('/mahasiswa/uploadttd', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'proses_uploadbukti'])->name('proses_uploadbukti');
    Route::get('/mahasiswa/hapus/{id}', [App\Http\Controllers\Mahasiswa\MahasiswaController::class, 'deletebukti'])->name('deletebukti');




});
