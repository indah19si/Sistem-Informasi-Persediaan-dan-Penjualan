<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SupplierSeeder::class,
            SatuanSedder::class,
            BarangSeeder::class,
            TransaksiPenjualanSeeder::class,
            TransaksiPembelianSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
