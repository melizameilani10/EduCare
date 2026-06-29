<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $siswa = \App\Models\User::where('role', 'siswa')->first();
    $kategori = \App\Models\Kategori::first();

    \App\Models\Pengaduan::create([
        'user_id' => $siswa->id,
        'kategori_id' => $kategori->id,
        'judul' => 'AC di Kelas Rusak',
        'isi_pengaduan' => 'AC di kelas XII IPA 1 tidak dingin sejak minggu lalu.',
        'status' => 'pending',
    ]);
}

}