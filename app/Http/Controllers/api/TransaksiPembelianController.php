<?php

namespace App\Http\Controllers\api;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\TransaksiPembelian;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TransaksiPembelianController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $lastTrx = TransaksiPembelian::withTrashed()
                ->orderByDesc('id')
                ->take(1)
                ->get()
                ->first();
            $trxUniqueCode = 'PBL';
            $trxCode = "{$trxUniqueCode}0001";

            if ($lastTrx) {
                $lastTrxCode = $lastTrx->trx_code;

                $lastTrxCode = explode($trxUniqueCode, $lastTrxCode);

                $trxCode = (int) $lastTrxCode[1] + 1;
                $trxCode = $trxUniqueCode . str_pad($trxCode, 4, '0', STR_PAD_LEFT);
            }

            $transaksiPembelian = TransaksiPembelian::create([
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

            $transaksiPembelian->barang()->attach($dataBarang->toArray());

            // Update Stok Barang
            $barangAll = Barang::whereIn('id', $listIdBarang->toArray())->get();

            foreach ($barangInput as $input) {
                $barang = $barangAll->firstWhere('id', $input['id_barang']);
                $barang->stok = $barang->stok + (int) $input['jumlah'];
                $barang->save();
            }

            DB::commit();

            return response()->json([
                'message' => 'transaksi pembelian berhasil!',
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
     * @param  \App\Models\TransaksiPembelian  $transaksiPembelian
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiPembelian $transaksiPembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransaksiPembelian  $transaksiPembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransaksiPembelian $transaksiPembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransaksiPembelian  $transaksiPembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiPembelian $transaksiPembelian)
    {
        //
    }
}
