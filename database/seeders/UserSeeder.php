<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
{
    // Buat 1 Admin
    \App\Models\User::create([
        'name' => 'Admin Sekolah',
        'email' => 'admin@sekolah.sch.id',
        'password' => bcrypt('admin123'),
        'role' => 'admin',
        'nis' => null,
    ]);

    // Buat 3 Siswa Dummy
    for ($i = 1; $i <= 3; $i++) {
        \App\Models\User::create([
            'name' => "Siswa $i",
            'email' => "siswa$i@sekolah.sch.id",
            'password' => bcrypt('siswa123'),
            'role' => 'siswa',
            'nis' => "NIS00" . $i,
        ]);
    }
}


}