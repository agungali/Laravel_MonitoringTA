<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Mahasiswa\DataBimbinganController;
use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\RegisterDosenController;

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
Route::get('/admin/daftardosen', [AdminController::class, 'getdosen'])->name('getdosen');

Auth::routes();

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/dosen/register', [RegisterDosenController::class, 'registerdosen'])->name('registerdosen');
    Route::post('/dosen/adddosen', [RegisterDosenController::class, 'adddosen'])->name('adddosen');
    //route update data data mahasiswa
    Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('edit');
    Route::put('/mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('update');
    Route::get('/mahasiswa/delete/{id}', [MahasiswaController::class, 'delete'])->name('delete');
    Route::get('/mahasiswa/detail/{id}', [MahasiswaController::class, 'detail'])->name('detail');
    
});


Route::group(['middleware' => ['auth', 'role:dosen']], function () {
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');
    Route::get('/mahasiswa/detail/{id}', [MahasiswaController::class, 'detail'])->name('detail');
    Route::post('/dosen/uploadttd', [DosenController::class, 'proses_uploadbuktittd'])->name('proses_uploadbuktittd');
});


Route::group(['middleware' => ['auth', 'role:mahasiswa']], function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('create');
    Route::post('/mahasiswa/createdata', [MahasiswaController::class, 'createdata'])->name('createdata');
    Route::post('/mahasiswa/uploadttd', [MahasiswaController::class, 'proses_uploadbukti'])->name('proses_uploadbukti');
    Route::get('/mahasiswa/hapus/{id}', [MahasiswaController::class, 'deletebukti'])->name('deletebukti');

    // Route Data Bimbingan
    Route::post('/mahasiswa/createdatabimbingan', [MahasiswaController::class, 'create_data_bimbingan'])->name('create_data_bimbingan');
    Route::get('/mahasiswa/delete_bimbingan/{id}', [MahasiswaController::class, 'delete_bimbingan'])->name('delete_bimbingan');
    Route::put('/mahasiswa/edit_bimbingan/{id}', [MahasiswaController::class, 'update_bimbingan'])->name('edit_bimbingan');
});
