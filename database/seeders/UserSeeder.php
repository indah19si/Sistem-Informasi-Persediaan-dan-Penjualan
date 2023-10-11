<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Permission\Role as PermissionRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()
            ->create([
                'name' => 'Indah',
                'email' => 'indah19si@mahasiswa.pcr.ac.id',
            ])
            ->assignRole(PermissionRole::SUPER_ADMIN);

        \App\Models\User::factory()
            ->create([
                'name' => 'Pemilik Toko',
                'email' => 'pemilik@tokosyfa.com',
            ])
            ->assignRole(PermissionRole::PEMILIK_TOKO);

        \App\Models\User::factory()
            ->create([
                'name' => 'Karyawan',
                'email' => 'karyawan@tokosyfa.com',
            ])
            ->assignRole(PermissionRole::KARYAWAN);
    }
}
