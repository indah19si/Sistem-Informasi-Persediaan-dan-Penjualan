@extends('layouts/contentNavbarLayout')

@section('title', 'Data Barang')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between">
        <h4 class="fw-bold py-3">
            <span class="text-muted fw-light">Ubah Data Barang</span>
        </h4>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="formAccountSettings" method="POST" action="{{ route('data-barang.update', $barang) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="kode_barang">Kode Barang</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">B -</span>
                                        <input type="text" id="kode_barang" name="kode_barang" class="form-control"
                                            placeholder="0001" value="{{ old('kode_barang', $barang->kode) }}"
                                            @readonly(true) />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input class="form-control" type="text" name="nama_barang" id="nama_barang"
                                        placeholder="Nama Barang" value="{{ old('nama_barang', $barang->nama) }}" />
                                </div>
                                <div class="mb-3 row">
                                    <label for="nama_barang" class="form-label">Stok Barang</label>
                                    <div class="col-6">
                                        <input class="form-control" type="number" name="stok_barang" id="stok_barang"
                                            placeholder="0" value="{{ old('stok_barang', $barang->stok) }}" />
                                        @error('stok_barang')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <select class="select2 form-select" name="satuan">
                                            <option value="" hidden>Satuan</option>
                                            @foreach ($satuan as $item)
                                                <option value="{{ $item->id }}" @selected(old('satuan', $barang->id_satuan) == $item->id)>
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('satuan')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="supplier" class="form-label">Nama Supplier</label>
                                    <select id="supplier" class="select2 form-select" name="supplier">
                                        <option hidden>Pilih Supplier</option>
                                        @foreach ($supplier as $item)
                                            <option value="{{ $item->id }}" @selected(old('supplier', $barang->id_supplier) == $item->id)>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="harga_beli" class="form-label">Harga Beli</label>
                                    <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                                        placeholder="3000" value="{{ old('nama_barang', $barang->harga_beli) }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="harga_jual" class="form-label">Harga Jual</label>
                                    <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                                        placeholder="3000" value="{{ old('nama_barang', $barang->harga_jual) }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="posisi" class="form-label">Posisi</label>
                                    <select id="posisi" class="select2 form-select" name="posisi">
                                        <option value="" hidden>Pilih Posisi</option>
                                        <option value="Rak Sembako" @selected(old('posisi', $barang->posisi) == 'Rak A')>Rak Sembako</option>
                                        <option value="Rak B" @selected(old('posisi', $barang->posisi) == 'Rak B')>Rak Minuman</option>
                                        <option value="Rak B" @selected(old('posisi', $barang->posisi) == 'Rak B')>Rak Makanan Ringan</option>
                                        <option value="Rak B" @selected(old('posisi', $barang->posisi) == 'Rak B')>Rak Bumbu</option>
                                    </select>
                                    @error('posisi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                            <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
