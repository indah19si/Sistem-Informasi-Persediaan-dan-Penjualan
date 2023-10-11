<?php

namespace Database\Seeders;

use App\Permission\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Permission\Role as PermissionRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => PermissionRole::SUPER_ADMIN]);
        
        $pemilikToko = Role::create(['name' => PermissionRole::PEMILIK_TOKO]);
        $karyawan = Role::create(['name' => PermissionRole::KARYAWAN]);

        $pemilikToko->givePermissionTo(Permission::LIHAT_DASHBOARD);
        $pemilikToko->givePermissionTo(Permission::KELOLA_DATA_BARANG);
        $pemilikToko->givePermissionTo(Permission::BUAT_DATA_SUPPLIER);
        $pemilikToko->givePermissionTo(Permission::LIHAT_DATA_SUPPLIER);
        $pemilikToko->givePermissionTo(Permission::UBAH_DATA_SUPPLIER);
        $pemilikToko->givePermissionTo(Permission::HAPUS_DATA_SUPPLIER);
        $pemilikToko->givePermissionTo(Permission::KELOLA_DATA_SUPPLIER);
        $pemilikToko->givePermissionTo(Permission::KELOLA_DATA_TRANSAKSI_PEMBELIAN);
        $pemilikToko->givePermissionTo(Permission::KELOLA_DATA_TRANSAKSI_PENJUALAN);
        $pemilikToko->givePermissionTo(Permission::LIHAT_LAPORAN_TRANSAKSI);
        
        $karyawan->givePermissionTo(Permission::LIHAT_DASHBOARD);
        $karyawan->givePermissionTo(Permission::KELOLA_DATA_BARANG);
        $karyawan->givePermissionTo(Permission::LIHAT_DATA_SUPPLIER);
        $karyawan->givePermissionTo(Permission::KELOLA_DATA_TRANSAKSI_PEMBELIAN);
        $karyawan->givePermissionTo(Permission::KELOLA_DATA_TRANSAKSI_PENJUALAN);
    }
}
