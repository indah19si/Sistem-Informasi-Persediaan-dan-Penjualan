<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Permission\Permission as PermissionConst;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => PermissionConst::LIHAT_DASHBOARD]);

        Permission::create(['name' => PermissionConst::KELOLA_DATA_BARANG]);

        Permission::create(['name' => PermissionConst::KELOLA_DATA_SUPPLIER]);
        Permission::create(['name' => PermissionConst::BUAT_DATA_SUPPLIER]);
        Permission::create(['name' => PermissionConst::LIHAT_DATA_SUPPLIER]);
        Permission::create(['name' => PermissionConst::UBAH_DATA_SUPPLIER]);
        Permission::create(['name' => PermissionConst::HAPUS_DATA_SUPPLIER]);

        Permission::create(['name' => PermissionConst::KELOLA_DATA_TRANSAKSI_PEMBELIAN]);

        Permission::create(['name' => PermissionConst::KELOLA_DATA_TRANSAKSI_PENJUALAN]);

        Permission::create(['name' => PermissionConst::LIHAT_LAPORAN_TRANSAKSI]);
    }
}
