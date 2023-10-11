@extends('layouts.contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboards.js') }}"></script>
@endsection

<!-- @section('content')
    <div class="d-none" data-barang-terlaris="{{ $barang_terlaris }}"
        data-bulan="{{ \Carbon\Carbon::now()->translatedFormat('F') }}" id="barang_terlaris"></div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bx bxs-package"></i>
                            </span>
                        </div>
                        <!-- <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div> -->
                    </div>
                    <span class="fw-semibold d-block mb-1">Barang</span>
                    <h3 class="card-title mb-2">{{ $count->barang }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="bx bx-down-arrow-alt"></i>
                            </span>
                            <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="chart success"
                                class="rounded">
                        </div>
                        <!-- <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div> -->
                    </div>
                    <span class="fw-semibold d-block mb-1">Transaksi Penjualan</span>
                    <h3 class="card-title mb-2">{{ $count->transaksi_penjualan }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-danger">
                                <i class="bx bx-up-arrow-alt"></i>
                            </span>
                        </div>
                        <!-- <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div> -->
                    </div>
                    <span class="fw-semibold d-block mb-1">Transaksi Pembelian</span>
                    <h3 class="card-title mb-2">{{ $count->transaksi_pembelian }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <span class="avatar-initial rounded bg-label-info">
                                <i class="fa-solid fa-user-group"></i>
                            </span>
                        </div>
                        <!-- <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div> -->
                    </div>
                    <span class="fw-semibold d-block mb-1">Supplier</span>
                    <h3 class="card-title mb-2">{{ $count->supplier }}</h3>
                    <!-- {{-- <small class="text-success fw-semibold"><i class='bx bx-up-arrow-alt'></i> +72.80%</small> --}} -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Total Pembelian Bulan Ini</span>
                    <hr>
                    <h3 class="card-title mb-2">
                        Rp. {{ number_format($total_trx->total_pembelian, 0, ',', '.') }}
                    </h3>
                    
                    {{-- <small @class([
                        'fw-semibold',
                        'text-success' => $total_trx->total_pembelian_percent > 0,
                        'text-warning' => $total_trx->total_pembelian_percent === 0,
                        'text-danger' => $total_trx->total_pembelian_percent < 0,
                    ])>
                        <i @class([
                            'bx bx-up-arrow-alt' => $total_trx->total_pembelian_percent > 0,
                            'fas fa-equals' => $total_trx->total_pembelian_percent === 0,
                            'bx bx-down-arrow-alt' => $total_trx->total_pembelian_percent < 0,
                        ])></i>
                        {{ round($total_trx->total_pembelian_percent) }}%
                    </small> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Total Penjualan Bulan Ini</span>
                    <hr>
                    <h3 class="card-title mb-2">Rp. {{ number_format($total_trx->total_penjualan, 0, ',', '.') }}</h3>

                    {{-- <small @class([
                        'fw-semibold',
                        'text-success' => $total_trx->total_penjualan_percent > 0,
                        'text-warning' => $total_trx->total_penjualan_percent === 0,
                        'text-danger' => $total_trx->total_penjualan_percent < 0,
                    ])>
                        <i @class([
                            'bx bx-up-arrow-alt' => $total_trx->total_penjualan_percent > 0,
                            'fas fa-equals' => $total_trx->total_penjualan_percent === 0,
                            'bx bx-down-arrow-alt' => $total_trx->total_penjualan_percent < 0,
                        ])></i>
                        {{ round($total_trx->total_penjualan_percent) }}%
                    </small> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Pendapatan Bulanan</span>
                    <hr>
                    <h3 class="card-title mb-2">
                        Rp. {{ number_format($total_trx->total_pendapatan_bulanan, 0, ',', '.') }}
                    </h3>
                    <small class="text-danger fw-semibold"></small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Barang Terlaris</span>
                    <hr>
                    <div id="totalRevenueChart" class="px-2" style="min-height: 315px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
        @if ($barangs->isNotEmpty())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Peringatan!</strong> Persediaan dibawah safety stock. Harap menambahkan persediaan kembali
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-flex justify-content-between mb-1">
                        <span>Barang Dibawah Safety Stock</span>
                        <select id="supplier" class="select2 form-select w-50" name="supplier">
                            <option value="">All Supplier</option>
                            @foreach ($suppliers as $item)
                                <option value="{{ $item->id }}"@selected(old('supplier') == $item->id)>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </span>
                    <hr>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Safety Stock</th>
                                    <th>Satuan</th>
                                    {{-- <th>Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($barangs as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->barang->nama }}</td>
                                        <td class="text-danger">
                                            {{ $item->barang->stok }}
                                        </td>
                                        <td>{{ $item->ss }}</td>
                                        <td>{{ $item->barang->satuan->nama }}</td>
                                        {{-- <td>
                                            <a class="btn btn-sm btn-success" href="{{ route('transaksi-pembelian.create') }}">
                                                <i class="fa-sharp fa-solid fa-plus fa-lg"></i>
                                            </a>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection -->
