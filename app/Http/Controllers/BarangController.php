<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use Illuminate\Support\Carbon;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::with(['supplier', 'satuan'])
            ->get()
            ->map(function ($item) {
                $oneYearAgo = Carbon::now()->subYears(1)->year;  

                return (object) [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'stok' => $item->stok,
                    'ss' => $item->perhitungan?->firstWhere('tahun_transaksi', $oneYearAgo)?->ss ?: 0,
                    'nama_supplier' => $item->supplier->nama,
                    'harga_beli' => $item->harga_beli,
                    'harga_jual' => $item->harga_jual,
                    'posisi' => $item->posisi,
                ];
            });
        $supplier = Supplier::all();

        return view('content.pages.data-barang')
            ->with(compact('data', 'supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $satuan = Satuan::all();

        $lastBarang = Barang::withTrashed()
            ->orderByDesc('id')
            ->take(1)
            ->get()
            ->first();

        $kode = ($lastBarang) ? (int) explode('B', $lastBarang->kode)[1] + 1 : 1;
        $kode = str_pad($kode, 4, '0', STR_PAD_LEFT);

        return view('content.pages.data-barang-add')
            ->with(compact('supplier', 'kode', 'satuan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangRequest $request)
    {
        $barang = Barang::create([
            'nama' => $request->post('nama_barang'),
            'kode' => 'B' . $request->post('kode_barang'),
            'stok' => $request->post('stok_barang'),
            'id_supplier' => $request->post('supplier'),
            'id_satuan' => $request->post('satuan'),
            'harga_beli' => $request->post('harga_beli'),
            'harga_jual' => $request->post('harga_jual'),
            'posisi' => $request->post('posisi'),
        ]);

        if ($barang instanceof Barang) {
            //
        } else {
            //
        }

        return redirect()->route('data-barang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        return view('content.pages.data-barang-detail')
            ->with(compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        $supplier = Supplier::all();
        $satuan = Satuan::all();

        return view('content.pages.data-barang-edit')
            ->with(compact('supplier', 'barang', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBarangRequest  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $updatedRow = $barang->update([
            'nama' => $request->post('nama_barang'),
            'id_supplier' => $request->post('supplier'),
            'harga_beli' => $request->post('harga_beli'),
            'harga_jual' => $request->post('harga_jual'),
            'posisi' => $request->post('posisi'),
        ]);

        if ($updatedRow > 0) {
            //
        } else {
            //
        }

        return redirect()->route('data-barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $isDeleted = $barang->delete();

        if ($isDeleted) {
            //
        } else {
            //
        }

        return redirect()->route('data-barang.index');
    }
}
