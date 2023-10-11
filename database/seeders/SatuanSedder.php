<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Satuan::factory()->createMany([
            ['nama' => 'Dus'],
            ['nama' => 'Renceng'],
            ['nama' => 'Kg'],
            ['nama' => 'Pcs'],
            ['nama' => 'Liter'],
            ['nama' => 'Kaleng'],
            ['nama' => 'Botol'],
            ['nama' => 'Bks'],
        ]);
    }
}
