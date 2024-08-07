<?php

use App\Http\Controllers\KeuanganController;
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

Route::controller(KeuanganController::class)->group(function () {
    Route::get('/cekDataPemasukan', 'cekDataPemasukan');
    Route::get('/cekDataPengeluaran', 'cekDataPengeluaran');
    Route::get('/getJmlPemasukan', 'getJmlPemasukan');
    Route::get('/getJmlPengeluaran', 'getJmlPengeluaran');
    Route::get('/getDataPemasukan', 'getDataPemasukan');
    Route::get('/getDataPengeluaran', 'getDataPengeluaran');
    Route::delete('/deletePemasukan/{id}', 'deletePemasukan');
    Route::post('/saveData', 'saveData');
    Route::put('/updateData/{id}', 'updateData');
});