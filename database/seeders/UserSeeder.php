<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@school.com',
            'password' => bcrypt('12345678')
        ]);
        $admin->assignRole('admin');

        $pembimbing = User::factory()->create([
            'name' => 'pembimbing',
            'email' => 'pembimbing@school.com',
            'password' => bcrypt('12345678')
        ]);
        $pembimbing->assignRole('pembimbing');

        $siswa = User::factory()->create([
            'name' => 'siswa',
            'email' => 'siswa@school.com',
            'password' => bcrypt('12345678')
        ]);
        $siswa->assignRole('siswa');

        $perusahaan = User::factory()->create([
            'name' => 'perusahaan',
            'email' => 'perusahaan@school.com',
            'password' => bcrypt('12345678')
        ]);
        $perusahaan->assignRole('perusahaan');
    }
}
