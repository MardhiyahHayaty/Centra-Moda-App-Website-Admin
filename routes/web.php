<?php

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

Route::get('/logins', function () {
    return view('login');
});
Route::get('/jenis_barangs', [App\Http\Controllers\JenisBarangController::class, 'index']);
Route::get('/barang_masuks', [App\Http\Controllers\BarangMasukController::class, 'index']);
Route::get('/barangs', [App\Http\Controllers\BarangController::class, 'index']);
Route::get('/admins', [App\Http\Controllers\AdminController::class, 'index']);
Route::get('/barang_keluars', [App\Http\Controllers\BarangKeluarController::class, 'index']);
Route::get('/pegawais', [App\Http\Controllers\PegawaiController::class, 'index']);
Route::get('/suppliers', [App\Http\Controllers\SupplierController::class, 'index']);

Route::post('/postlogin', 'LoginController@postlogin')->name('postlogin');