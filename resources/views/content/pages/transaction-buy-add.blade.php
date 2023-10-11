@extends('layouts/contentNavbarLayout')

@section('title', 'Add Transaksi Pembelian')

@section('page-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
@endsection

@section('page-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/js/pages/transaction-buy-add.js') }}"></script>
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Tambah Transaksi Pembelian</span>
        </h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">
                        <h5>Transaksi Pembelian</h5>
                    </div>
                    <div class="card-subtitle">
                        <h6 class="text-muted">
                            {{ $trxId }} | <input class="d-inline-block form-control" style="width: 10em"
                                type="date" value="{{ date('Y-m-d') }}" id="tanggal_trx">
                        </h6>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h5>Input Data</h5>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="supplier" class="form-label">Supplier</label>
                                                <select id="supplier" class="select2 form-select" name="supplier">
                                                    <option value="" hidden>Pilih Supplier</option>
                                                    @foreach ($supplier as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('barang')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="barang" class="form-label">Barang</label>
                                                <select id="barang" class="select2 form-select" name="barang">
                                                    <option value="" hidden>Pilih Barang</option>
                                                </select>
                                                @error('barang')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga</label>
                                                <input type="number" class="form-control" id="harga" name="harga"
                                                    placeholder="0" value="" readonly />
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah" class="form-label">Jumlah</label>
                                                <input type="number" class="form-control" id="jumlah" name="jumlah"
                                                    placeholder="0" value="" />
                                                <small class="text-muted">Stok:
                                                    <span id="stok">0</span>
                                                    <span class="text-success">+</span><span id="stok_plus"
                                                        class="text-success">0</span>
                                                </small>
                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" class="btn btn-sm btn-primary me-2"
                                                    id="btn_tambah_item">
                                                    <i class='bx bx-plus'></i> Item
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h5>Data Pembelian</h5>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table" id="datatable">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Barang</th>
                                                            <th>Harga</th>
                                                            <th>Jumlah</th>
                                                            <th>Total</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="mt-3 text-muted">Total :
                                <span class="fw-bold font-monospace">Rp.</span>
                                <span class="fw-bold font-monospace" id="total_transaksi">0</span>
                            </h6>
                        </div>
                    </div>
                    <div class="mt-2 float-end">
                        <button type="submit" class="btn btn-primary me-2" id="btn_simpan_transaksi">
                            Simpan Transaksi
                        </button>
                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
