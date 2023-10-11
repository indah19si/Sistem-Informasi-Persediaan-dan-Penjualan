<?php

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransaksiPembelianController;
use App\Http\Controllers\Api\TransaksiPenjualanController;

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

Route::get('/supplier/{supplier}', function(Supplier $supplier) {
    try {
        $supplier->barang;
        return response()->json($supplier->barang);
    } catch (Exception $e) {
        return response()->json([
            'message' => 'internal server error',
            'additional_info' =>  $e->getMessage(),
        ], 500);
    }
});

Route::get('/barang/{barang}', function (Barang $barang) {
    try {
        $barang->supplier;
        return response()->json($barang);
    } catch (Exception $e) {
        return response()->json([
            'message' => 'internal server error',
            'additional_info' =>  $e->getMessage(),
        ], 500);
    }
});

Route::apiResource('transaksi_penjualan', TransaksiPenjualanController::class, [
    'names' => [
        'index' => 'transaksi_penjualan.api.index',
        'store' => 'transaksi_penjualan.api.store',
        'update' => 'transaksi_penjualan.api.update',
        'destroy' => 'transaksi_penjualan.api.delete'
    ]
]);

Route::apiResource('transaksi_pembelian', TransaksiPembelianController::class, [
    'names' => [
        'index' => 'transaksi_pembelian.api.index',
        'store' => 'transaksi_pembelian.api.store',
        'update' => 'transaksi_pembelian.api.update',
        'destroy' => 'transaksi_pembelian.api.delete'
    ]
]);
