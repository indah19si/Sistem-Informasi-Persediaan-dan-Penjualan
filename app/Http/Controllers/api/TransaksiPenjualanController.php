<?php

namespace App\Http\Controllers\Api;

use App\Models\Barang;
use App\Models\TransaksiPenjualan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransaksiPenjualanRequest;
use App\Http\Requests\UpdateTransaksiPenjualanRequest;

class TransaksiPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransaksiPenjualanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaksiPenjualanRequest $request)
    {
        try {
            DB::beginTransaction();

            $lastTrx = TransaksiPenjualan::withTrashed()
                ->orderByDesc('id')
                ->take(1)
                ->get()
                ->first();
            $trxUniqueCode = 'PJL';
            $trxCode = "{$trxUniqueCode}0001";

            if ($lastTrx) {
                $lastTrxCode = $lastTrx->trx_code;

                $lastTrxCode = explode($trxUniqueCode, $lastTrxCode);

                $trxCode = (int) $lastTrxCode[1] + 1;
                $trxCode = $trxUniqueCode . str_pad($trxCode, 4, '0', STR_PAD_LEFT);
            }

            $transaksiPenjualan = TransaksiPenjualan::create([
                'trx_code' => $trxCode,
                'created_at' => $request->post('tanggal_transaksi'),
                'updated_at' => $request->post('tanggal_transaksi'),
            ]);

            $barangInput = collect($request->post('barang'));
            $listIdBarang = $barangInput->pluck('id_barang');

            $dataBarang = $listIdBarang->combine(
                $barangInput->map(function ($value) {
                    return ['jumlah' => $value['jumlah']];
                })
            );

            $transaksiPenjualan->barang()->attach($dataBarang->toArray());

            // Update Stok Barang
            $barangAll = Barang::whereIn('id', $listIdBarang->toArray())->get();

            foreach ($barangInput as $input) {
                $barang = $barangAll->firstWhere('id', $input['id_barang']);
                $barang->stok = $barang->stok - (int) $input['jumlah'];
                $barang->save();
            }

            DB::commit();

            return response()->json([
                'message' => 'transaksi penjualan berhasil!',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'server error',
                'additional_info' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransaksiPenjualan  $transaksiPenjualan
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiPenjualan $transaksiPenjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransaksiPenjualan  $transaksiPenjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiPenjualan $transaksiPenjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransaksiPenjualanRequest  $request
     * @param  \App\Models\TransaksiPenjualan  $transaksiPenjualan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransaksiPenjualanRequest $request, TransaksiPenjualan $transaksiPenjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransaksiPenjualan  $transaksiPenjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiPenjualan $transaksiPenjualan)
    {
        //
    }
}
