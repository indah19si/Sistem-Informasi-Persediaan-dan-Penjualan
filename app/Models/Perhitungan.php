<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Perhitungan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'perhitungan_views';

    protected $with = ['barang', 'barang.supplier', 'barang.satuan'];

    public function barang(): HasOne
    {
        return $this->hasOne(Barang::class, 'id', 'id_barang')->withTrashed();
    }

    protected function ss(): Attribute
    {
        return Attribute::make(
            function () {
                $kebutuhanSetahun = $this->kebutuhan_setahun;
                $totalTransaksi = $this->total_transaksi;
                $penjualanMax = $this->penjualan_maksimal;
                $leadTime = $this->barang->supplier->lead_time;

                $hasil = round(($penjualanMax - ($kebutuhanSetahun / $totalTransaksi)) * $leadTime);
                // 500 - (797 / 17) * 2 = 
                return $hasil;
            }
        );
    }
}
