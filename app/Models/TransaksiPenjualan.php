<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TransaksiPenjualan extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trx_code', 'created_at', 'updated_at'
    ];

    function total(): Attribute
    {
        return Attribute::make(
            function () {
                $total = $this->barang
                    ->sum(function ($barang) {
                        return $barang->pivot->jumlah * $barang->harga_jual;
                    });

                return $total;
            }
        );
    }

    function barang(): BelongsToMany
    {
        return $this->belongsToMany(Barang::class, 'transaksi_penjualan_barangs', 'id_trx', 'id_barang')->withPivot('jumlah');
    }
}
