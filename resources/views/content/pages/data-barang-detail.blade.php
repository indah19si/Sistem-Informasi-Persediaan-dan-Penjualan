@extends('layouts.contentNavbarLayout')

@section('title', 'Detail Data Barang')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Detail Data Barang</span>
        </h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 col-sm-3">Kode Barang</div>
                        <div class="col-md-1 col-sm-1 text-center">:</div>
                        <div class="col-md-4 col-sm-4">{{ $barang->kode }}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-sm-3">Nama Barang</div>
                        <div class="col-md-1 col-sm-1 text-center">:</div>
                        <div class="col-md-4 col-sm-5">{{ $barang->nama }}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-sm-3">Satuan Barang</div>
                        <div class="col-md-1 col-sm-1 text-center">:</div>
                        <div class="col-md-4 col-sm-4">{{ $barang->satuan->nama }}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-sm-3">Stok Barang</div>
                        <div class="col-md-1 col-sm-1 text-center">:</div>
                        <div @class([
                            'col-md-4 col-sm-4',
                            'fw-bold',
                            'text-success' =>
                                $barang->stok >
                                $barang->perhitungan?->firstWhere(
                                    'tahun_transaksi',
                                    \Carbon\Carbon::now()->subYear(1)->year)?->ss,
                            'text-danger' =>
                                $barang->stok <=
                                $barang->perhitungan?->firstWhere(
                                    'tahun_transaksi',
                                    \Carbon\Carbon::now()->subYear(1)->year)?->ss,
                        ])>{{ $barang->stok }}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-sm-3">Safety Stok</div>
                        <div class="col-md-1 col-sm-1 text-center">:</div>
                        <div class="col-md-4 col-sm-4">
                            {{ $barang->perhitungan?->firstWhere('tahun_transaksi', \Carbon\Carbon::now()->subYear(1)->year)?->ss }}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-sm-3">Nama Supplier</div>
                        <div class="col-md-1 col-sm-1 text-center">:</div>
                        <div class="col-md-4 col-sm-5">{{ $barang->supplier->nama }}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-sm-3">Harga Beli</div>
                        <div class="col-md-1 col-sm-1 text-center">:</div>
                        <div class="col-md-3 col-sm-3">
                            <div class="d-flex justify-content-between">
                                <span class="font-monospace">Rp.</span>
                                <span class="font-monospace">{{ number_format($barang->harga_beli, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-sm-3">Harga Jual</div>
                        <div class="col-md-1 col-sm-1 text-center">:</div>
                        <div class="col-md-3 col-sm-3">
                            <div class="d-flex justify-content-between">
                                <span class="font-monospace">Rp.</span>
                                <span class="font-monospace">{{ number_format($barang->harga_jual, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 col-sm-3">Posisi</div>
                        <div class="col-md-1 col-sm-1 text-center">:</div>
                        <div class="col-md-3 col-sm-4">{{ $barang->posisi }}</div>
                    </div>
                    <div class="mt-4 float-end">
                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
