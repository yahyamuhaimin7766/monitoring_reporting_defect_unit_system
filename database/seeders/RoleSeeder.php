<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
                 Role::create(['name' => 'pembimbing']);
                 Role::create(['name' => 'siswa']);
                 Role::create(['name' => 'perusahaan']);
        $admin->givePermissionTo([
                    'create-role',
                    'edit-role',
                    'delete-role',
                    'create-user',
                    'edit-user',
                    'delete-user'
                ]);
        $admin->givePermissionTo([
                    'create-user',
                    'edit-user',
                    'delete-user'
                ]);
    }
}
