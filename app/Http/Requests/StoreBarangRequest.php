<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kode_barang' => ['required'],
            'nama_barang' => ['required'],
            'stok_barang' => ['required', 'min:0'],
            'satuan' => ['required'],
            'supplier' => ['required'],
            'harga_beli' => ['required'],
            'harga_jual' => ['required'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'stok_barang' => 'Stok Barang',
            'satuan' => 'Satuan',
            'supplier' => 'Supplier',
            'harga_beli' => 'Harga Beli',
            'harga_jual' => 'Harga Jual',
        ];
    }
}
