@extends('layouts/contentNavbarLayout')

@section('title', 'Add Transaksi Penjualan')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
@endsection

@section('page-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Detail Transaksi Penjualan</span>
        </h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">
                        <h5>Transaksi Penjualan</h5>
                    </div>
                    <div class="card-subtitle">
                        <h6 class="text-muted">
                            {{ $trx->trx_code }} | {{ \Carbon\Carbon::parse($trx->created_at)->translatedFormat('d F Y') }}
                        </h6>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table" id="datatable">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Kode Barang</th>
                                                            <th>Nama Barang</th>
                                                            <th width="15%">Jumlah</th>
                                                            <th>Harga</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        @foreach ($trx->barang as $item)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $item->kode }}</td>
                                                                <td>{{ $item->nama }}</td>
                                                                <td class="text-end font-monospace">
                                                                    {{ $item->pivot->jumlah }}
                                                                <td>
                                                                    <div
                                                                        class="d-flex justify-content-between font-monospace">
                                                                        <span>Rp.</span>
                                                                        <span>
                                                                            {{ number_format($item->harga_jual, 0, ',', '.') }}
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                </td>
                                                                <td>
                                                                    <div
                                                                        class="d-flex justify-content-between font-monospace">
                                                                        <span>Rp.</span>
                                                                        <span>
                                                                            {{ number_format($item->harga_jual * $item->pivot->jumlah, 0, ',', '.') }}
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 float-end">
                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
