<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TransaksiPembelian extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'trx_code', 'created_at', 'updated_at'
    ];

    function total(): Attribute
    {
        return Attribute::make(
            function () {
                $total = $this->barang
                    ->sum(function ($barang) {
                        return $barang->pivot->jumlah * $barang->harga_beli;
                    });

                return $total;
            }
        );
    }

    function barang(): BelongsToMany
    {
        return $this->belongsToMany(Barang::class, 'transaksi_pembelian_barangs', 'id_trx', 'id_barang')->withPivot('jumlah');
    }
}
