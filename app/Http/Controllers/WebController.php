<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPenjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class WebController extends Controller
{

    public function showTransactionBuy()
    {
        $data = [
            (object)[
                'nama_supplier' => 'Supplier 1',
                'nama_barang' => 'Barang 1',
                'tanggal_pembelian' => '15-04-2023',
            ]
        ];

        return view('content.pages.transaction-buy')
            ->with(compact('data'));
    }

    public function showAddTransactionBuy()
    {
        $supplier = Supplier::all();
        return view('content.pages.transaction-buy-add')
            ->with(compact('supplier'));
    }

    public function showLaporan()
    {
        return view('content.pages.laporan');
    }

    public function reportDataBarang(Request $request)
    {
        $idSupplier = $request->post('supplier');
        $data = Barang::where('id_supplier', $idSupplier)
            ->get()
            ->map(function ($barang, $index) {
                return (object)[
                    'no' => $index + 1,
                    'nama_barang' => $barang->nama,
                    'satuan' => $barang->satuan->nama,
                    'stok' => $barang->stok,
                    'harga_beli' => $barang->harga_beli,
                    'harga_jual' => $barang->harga_jual,
                ];
            })
            ->all();

        $pdf = PDF::loadView('exports.barang_export', compact('data'));

        return $pdf->download('data-barang.pdf');
    }

    public function reportTransaksiPenjualan(Request $request)
    {
        $fromDate = $request->post('from_date');
        $toDate = $request->post('to_date');

        $data = TransaksiPenjualan::whereBetween('created_at', [$fromDate, $toDate])->get();

        $pdf = PDF::loadView('exports.transaksi_penjualan_export', compact('data'));

        return $pdf->download('transaksi_penjualan.pdf');
    }

    public function reportTransaksiPembelian(Request $request)
    {
        $fromDate = $request->post('from_date');
        $toDate = $request->post('to_date');

        $data = TransaksiPembelian::whereBetween('created_at', [$fromDate, $toDate])->get();

        $pdf = PDF::loadView('exports.transaksi_pembelian_export', compact('data'));

        return $pdf->download('transaksi_pembelian.pdf');
    }
}
