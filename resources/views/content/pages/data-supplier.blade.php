@extends('layouts/contentNavbarLayout')

@section('title', 'Data Supplier')

@section('page-script')
    <script src="{{ asset('assets/js/pages/data-supplier.js') }}"></script>
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Data Supplier</span>
        </h4>
        @can('create', new \App\Models\Supplier)
            <a href="{{ route('data-supplier.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Data Supplier
            </a>
        @endcan
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
                                    <th>Nama Supplier</th>
                                    <th>Lead Time</th>
                                    <th>Alamat</th>
                                    <th>No Hp</th>
                                    @canany(['update', 'delete'], new \App\Models\Supplier)
                                        <th width="3%">Aksi</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="text-end font-monospace">{{ $item->lead_time }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        @canany(['update', 'delete'], $item)
                                            <td class="text-center">
                                                {{-- <a class="btn btn-primary btn-sm" href="">
                                                <i class='bx bxs-search-alt-2'></i>
                                            </a> --}}
                                                @can('update', $item)
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('data-supplier.edit', $item) }}">
                                                        <i class="bx bxs-pencil bx-xs"></i>
                                                    </a>
                                                @endcan
                                                @can('delete', $item)
                                                    <form id="formDelete" class="d-inline formDelete" method="POST"
                                                        action="{{ route('data-supplier.destroy', $item) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class='bx bxs-trash-alt'></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        @endcanany
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
