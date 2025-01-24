<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/pegawais', App\Http\Controllers\Api\PegawaiController::class);
Route::apiResource('/admins', App\Http\Controllers\Api\AdminController::class);
Route::apiResource('/suppliers', App\Http\Controllers\Api\SupplierController::class);
Route::apiResource('/jenis_barangs', App\Http\Controllers\Api\JenisBarangController::class);
Route::apiResource('/barangs', App\Http\Controllers\Api\BarangController::class);
Route::apiResource('/barang_masuks', App\Http\Controllers\Api\BarangMasukController::class);
Route::apiResource('/barang_keluars', App\Http\Controllers\Api\BarangKeluarController::class);
//Route::apiResource('/jenis_barangs', App\Http\Controllers\Api\JenisBarangController::class);