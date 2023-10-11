<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Support\Carbon;
use App\Models\TransaksiPembelian;
use App\Http\Requests\StoreTransaksiPembelianRequest;
use App\Http\Requests\UpdateTransaksiPembelianRequest;
use App\Models\Supplier;

class TransaksiPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TransaksiPembelian::with(['barang', 'barang.supplier'])
            ->orderByDesc('created_at')
            ->get();

        return view('content.pages.transaction-buy')
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
        $supplier = Supplier::all();
        $date = Carbon::now()->translatedFormat('d F Y');
        $trxUniqueCode = 'PBL';
        $trxId = "{$trxUniqueCode}0001";

        $lastTrx = TransaksiPembelian::withTrashed()
            ->orderByDesc('id')
            ->take(1)
            ->get()
            ->first();
            
        if ($lastTrx) {
            $lastTrxCode = $lastTrx->trx_code;

            $lastTrxCode = explode($trxUniqueCode, $lastTrxCode);

            $trxId = (int) $lastTrxCode[1] + 1;
            $trxId = $trxUniqueCode . str_pad($trxId, 4, '0', STR_PAD_LEFT);
        }

        return view('content.pages.transaction-buy-add')
            ->with(compact('barang', 'supplier', 'date', 'trxId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransaksiPembelianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaksiPembelianRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransaksiPembelian  $transaksiPembelian
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiPembelian $transaksiPembelian)
    {
        $trx = $transaksiPembelian;

        return view('content.pages.transaction-buy-detail')
            ->with(compact('trx'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransaksiPembelian  $transaksiPembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiPembelian $transaksiPembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransaksiPembelianRequest  $request
     * @param  \App\Models\TransaksiPembelian  $transaksiPembelian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransaksiPembelianRequest $request, TransaksiPembelian $transaksiPembelian)
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
        $isDeleted = $transaksiPembelian->delete();

        if ($isDeleted) {
            //
        } else {
            //
        }

        return redirect()->route('transaksi-pembelian.index');
    }
}
