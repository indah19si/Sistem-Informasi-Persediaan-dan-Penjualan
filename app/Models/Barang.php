<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode',
        'nama',
        'stok',
        'harga_beli',
        'harga_jual',
        'posisi',
        'id_supplier',
        'id_satuan'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'barang';

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id')->withTrashed();
    }

    public function satuan(): BelongsTo
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id');
    }

    public function perhitungan(): HasMany
    {
        return $this->hasMany(Perhitungan::class, 'id_barang', 'id');
    }

}