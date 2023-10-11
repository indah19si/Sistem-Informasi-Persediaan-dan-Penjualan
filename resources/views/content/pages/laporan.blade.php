@extends('layouts/contentNavbarLayout')

@section('title', 'Laporan')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Laporan</span>
        </h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h4>Penjualan</h4>
                    <hr>
                    <form action="{{ route('report.transaksi.penjualan') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="form-group row justify-content-between">
                            <div class="col-5">
                                <input type="date" class="form-control" id="from_date" name="from_date"
                                    value="{{ \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateString() }}" />
                            </div>
                            <div class="col-auto align-items-center d-flex">
                                <i class='bx bx-right-arrow-alt'></i>
                            </div>
                            <div class="col-5">
                                <input type="date" class="form-control" id="to_date" name="to_date"
                                    value="{{ \Carbon\Carbon::now()->toDateString() }}" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-3">
                            <i class='bx bxs-printer'></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h4>Pembelian</h4>
                    <hr>
                    <form action="{{ route('report.transaksi.pembelian') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="form-group row justify-content-between">
                            <div class="col-5">
                                <input type="date" class="form-control" id="from_date" name="from_date"
                                    value="{{ \Carbon\Carbon::now()->subMonths(1)->firstOfMonth()->toDateString() }}" />
                            </div>
                            <div class="col-auto align-items-center d-flex">
                                <i class='bx bx-right-arrow-alt'></i>
                            </div>
                            <div class="col-5">
                                <input type="date" class="form-control" id="to_date" name="to_date"
                                    value="{{ \Carbon\Carbon::now()->toDateString() }}" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mt-3">
                            <i class='bx bxs-printer'></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
