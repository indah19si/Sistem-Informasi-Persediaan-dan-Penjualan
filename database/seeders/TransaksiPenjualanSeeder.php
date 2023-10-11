<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransaksiPenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barang = \App\Models\Barang::all();
        $allTrx = \App\Models\TransaksiPenjualan::factory(rand(200, 350))->create();

        foreach ($allTrx->lazy() as $trx) {
            $barangRandom = $barang->random(rand(1, 9));
            $listIdBarang = $barangRandom->pluck('id');

            $dataBarang = $listIdBarang->combine(
                $listIdBarang->map(function ($barang) {
                    return ['jumlah' => rand(6, 30)];
                })
            );

            $trx->barang()->attach($dataBarang);
        }
    }
}
