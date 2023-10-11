<?php

namespace App\Models;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'alamat', 'no_hp', 'lead_time'];

    function barang(): HasMany
    {
        return $this->hasMany(Barang::class, 'id_supplier', 'id');
    }

    // protected function ss(): Attribute
    // {
    //     return Attribute::make(
    //         function () {
    //             $dayInYear = (int) date('z', mktime(0, 0, 0, 12, 31, $this->tahun_transaksi)) + 1;
    //             $hasil = (int) $this->kebutuhan_setahun / $dayInYear * $this->barang->supplier->lead_time;

    //             return $hasil;
    //         }
    //     );
    // }
}
