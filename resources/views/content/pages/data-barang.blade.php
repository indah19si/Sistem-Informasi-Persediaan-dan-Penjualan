@extends('layouts.contentNavbarLayout')

@section('title', 'Data Barang')

@section('page-script')
    <script src="{{ asset('assets/js/pages/data-barang.js') }}"></script>
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Data Barang</span>
        </h4>
        <div class="d-flex">
            <a href="{{ route('data-barang.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm me-2">
                <i class="fas fa-plus fa-sm text-white-50"></i> Data Barang
            </a>
            <button data-bs-toggle="modal" data-bs-target="#modalCenter"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-print fa-sm text-white"></i>
            </button>
        </div>
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
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Safety Stock</th>
                                    <th>Nama Supplier</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Posisi</th>
                                    <th width="3%">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td @class([
                                            'text-end',
                                            'font-monospace',
                                            'text-danger' => $item->stok <= $item->ss,
                                        ])>{{ $item->stok }}</td>
                                        <td class="text-end font-monospace">{{ $item->ss }}</td>
                                        <td>{{ $item->nama_supplier }}</td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <span class="font-monospace">Rp.</span>
                                                <span
                                                    class="font-monospace">{{ number_format($item->harga_beli, 0, ',', '.') }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <span class="font-monospace">Rp.</span>
                                                <span
                                                    class="font-monospace">{{ number_format($item->harga_jual, 0, ',', '.') }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $item->posisi }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('data-barang.show', $item->id) }}">
                                                <i class='bx bxs-info-circle bx-xs'></i>
                                            </a>
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ route('data-barang.edit', $item->id) }}">
                                                <i class="bx bxs-pencil bx-xs"></i>
                                            </a>
                                            <form id="formDelete" class="d-inline formDelete" method="POST"
                                                action="{{ route('data-barang.destroy', $item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class='bx bxs-trash-alt bx-xs'></i>
                                                </button>
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

@section('modal')
    <div class="col-lg-4 col-md-6">
        <small class="text-light fw-semibold">Vertically centered</small>
        <div class="mt-3">
            <!-- Modal -->
            <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Cetak Data Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('report.barang') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="supplier" class="form-label">Nama Supplier</label>
                                    <select id="supplier" class="select2 form-select" name="supplier">
                                        <option hidden>Pilih Supplier</option>
                                        @foreach ($supplier as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Print</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
