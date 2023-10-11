@extends('layouts/contentNavbarLayout')

@section('title', 'Data Supplier')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Tambah Data Supplier</span>
        </h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{ route('data-supplier.store') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md">
                                <label for="nama" class="form-label">Nama Supplier</label>
                                <input class="form-control" type="text" id="nama" name="nama"
                                    placeholder="Nama Supplier" value="{{ old('nama') }}" autofocus />
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input class="form-control" type="text" name="alamat" id="alamat"
                                    placeholder="Alamat" value="{{ old('alamat') }}"/>
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md">
                                <label for="no_hp" class="form-label">Nomor Hp</label>
                                <input class="form-control" type="text" name="no_hp" id="no_hp"
                                    placeholder="Nomor Hp" value="{{ old('no_hp') }}"/>
                                @error('no_hp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md">
                                <label for="lead_time" class="form-label">Lead Time</label>
                                <input class="form-control" type="number" name="lead_time" id="lead_time"
                                    placeholder="0" value="{{ old('lead_time') }}"/>
                                @error('lead_time')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
