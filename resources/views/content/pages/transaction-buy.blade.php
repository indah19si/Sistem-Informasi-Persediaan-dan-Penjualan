@extends('layouts/contentNavbarLayout')

@section('title', 'Transaksi Pembelian')

@section('page-script')
    <script src="{{ asset('assets/js/pages/transaction-buy.js') }}"></script>
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Transaksi Pembelian</span>
        </h4>
        <a href="{{ route('transaksi-pembelian.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Transaksi Pembelian
        </a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive table-stripped text-nowrap">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th>ID Transaksi</th>
                                    <th>Supplier</th>
                                    <th>Tanggal</th>
                                    <th width="17%">Total</th>
                                    <th width="3%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->trx_code }}</td>
                                        <td>{{ $item->barang[0]->supplier->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <div class="d-flex justify-content-between font-monospace">
                                                <span>Rp.</span>
                                                <span>{{ number_format($item->total, 0, ',', '.') }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('transaksi-pembelian.show', $item->id) }}">
                                                <i class='bx bxs-info-circle'></i>
                                            </a>
                                            <form id="formDelete" class="d-inline formDelete" method="POST"
                                                action="{{ route('transaksi-pembelian.destroy', $item) }}">
                                                @csrf
                                                @method('DELETE')
                                                <!-- <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class='bx bxs-trash-alt'></i>
                                                </button> -->
                                            </form>
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
@endsection
