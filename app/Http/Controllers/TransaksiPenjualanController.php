<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TransaksiPenjualan;

class TransaksiPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TransaksiPenjualan::with(['barang'])
            ->orderByDesc('created_at')
            ->get();

        return view('content.pages.transaction-sell')
            ->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        $date = Carbon::now()->translatedFormat('d F Y');
        $trxId = 'PJL0001';

        $lastTrx = TransaksiPenjualan::withTrashed()
            ->orderByDesc('id')
            ->take(1)
            ->get()
            ->first();

        if ($lastTrx) {
            $lastTrxCode = $lastTrx->trx_code;

            $lastTrxCode = explode('PJL', $lastTrxCode);

            $trxId = (int) $lastTrxCode[1] + 1;
            $trxId = 'PJL' . str_pad($trxId, 4, '0', STR_PAD_LEFT);
        }

        return view('content.pages.transaction-sell-add')
            ->with(compact('barang', 'date', 'trxId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransaksiPenjualan  $transaksiPenjualan
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiPenjualan $transaksiPenjualan)
    {
        $trx = $transaksiPenjualan;

        return view('content.pages.transaction-sell-detail')
            ->with(compact('trx'));
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransaksiPenjualan  $transaksiPenjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransaksiPenjualan $transaksiPenjualan)
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
        $isDeleted = $transaksiPenjualan->delete();

        if ($isDeleted) {
            //
        } else {
            //
        }

        return redirect()->route('transaksi-penjualan.index');
    }
}
