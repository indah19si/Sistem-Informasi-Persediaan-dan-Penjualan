<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Support\Carbon;
use App\Models\TransaksiPembelian;
use App\Models\TransaksiPenjualan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Perhitungan;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index(Request $request)
  {
   
    $count = (object)[
      'supplier' => Supplier::count(),
      'barang' => Barang::count(),
      'transaksi_penjualan' => TransaksiPenjualan::count(),
      'transaksi_pembelian' => TransaksiPembelian::count(),
    ];

    $awalBulanIni = Carbon::now()->firstOfMonth()->toDateTimeString();
    $akhirBulanIni = Carbon::now()
      ->lastOfMonth()
      ->addHours(23)
      ->addMinutes(59)
      ->addSeconds(59)
      ->toDateTimeString();

    $awalBulanLalu = Carbon::now()->subMonths()->firstOfMonth()->toDateTimeString();
    $akhirBulanLalu = Carbon::now()
      ->subMonths()
      ->lastOfMonth()
      ->addHours(23)
      ->addMinutes(59)
      ->addSeconds(59)
      ->toDateTimeString();

    $totalPembelianBulanIni = TransaksiPembelian::whereBetween('created_at', [$awalBulanIni, $akhirBulanIni])->get()->sum('total');
    $totalPembelianBulanLalu = TransaksiPembelian::whereBetween('created_at', [$awalBulanLalu, $akhirBulanLalu])->get()->sum('total');

    $totalPenjualanBulanIni = TransaksiPenjualan::whereBetween('created_at', [$awalBulanIni, $akhirBulanIni])->get()->sum('total');
    $totalPenjualanBulanLalu = TransaksiPenjualan::whereBetween('created_at', [$awalBulanLalu, $akhirBulanLalu])->get()->sum('total');

    $selisihTotalPembelian = $totalPembelianBulanIni - $totalPembelianBulanLalu;
    $persentaseSelisihTotalPembelian = 0;

    $selisihTotalPenjualan = $totalPenjualanBulanIni - $totalPenjualanBulanLalu;
    $persentaseSelisihTotalPenjualan = 0;

    $totalPendapatan = $totalPenjualanBulanIni - $totalPembelianBulanIni;

    $barang_terlaris = collect(
      DB::select(
        "SELECT tpb.id_barang, SUM(tpb.jumlah) as jumlah, b.nama
        FROM transaksi_penjualan_barangs tpb
        JOIN barang b ON b.id = tpb.id_barang
        JOIN transaksi_penjualans tp ON tp.id = tpb.id_trx
        WHERE tp.created_at BETWEEN ? AND ?
        GROUP BY tpb.id_barang, b.nama
        ORDER BY jumlah DESC
        LIMIT 10",
        [
          $awalBulanIni, $akhirBulanIni
        ]
      )
    );

    $barang_terlaris = $barang_terlaris->map(function ($barang) {
      return (object)[
        'jumlah' => $barang->jumlah,
        'nama' => $barang->nama,
      ];
    });

    $total_trx = (object)[
      'total_pembelian' => $totalPembelianBulanIni,
      'total_pembelian_percent' => $persentaseSelisihTotalPembelian,
      'total_penjualan' => $totalPenjualanBulanIni,
      'total_penjualan_percent' => $persentaseSelisihTotalPenjualan,
      'total_pendapatan_bulanan' => $totalPendapatan,
    ];
    $supplierParams = (int) $request->get('supplier');

    $suppliers = Supplier::all();
    $tahunLalu = Carbon::now()->subYears(1)->year;
    $barangs = Perhitungan::with(
      [
        'barang' => function ($q) {
          $q->orderBy('stok');
        }
      ]
    )
      ->where('tahun_transaksi', $tahunLalu)
      ->get()
      ->each(function ($barang) {
        $barang->kebutuhan_setahun = (int) $barang->kebutuhan_setahun;
      })
      ->filter(function ($value) use ($supplierParams){
        $isMoreThanSs = $value->barang->stok <= $value->ss;
        $supplierFilter = true;

        if ($supplierParams) {
          $supplierFilter = $value->barang->id_supplier == $supplierParams;
        }

        return $isMoreThanSs && $supplierFilter;
      });

    return view('content.dashboard.dashboards-analytics')
      ->with(compact('count', 'barangs', 'suppliers', 'total_trx', 'barang_terlaris'));
  }
}
