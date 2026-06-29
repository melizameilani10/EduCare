<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
public function run(): void
{
    $kategoris = [
        ['nama_kategori' => 'Fasilitas Sekolah', 'deskripsi' => 'Kerusakan atau keluhan fasilitas'],
        ['nama_kategori' => 'Proses Belajar', 'deskripsi' => 'Keluhan terkait pelajaran/guru'],
        ['nama_kategori' => 'Perundungan (Bullying)', 'deskripsi' => 'Laporan kasus bullying'],
        ['nama_kategori' => 'Kebersihan', 'deskripsi' => 'Masalah kebersihan lingkungan'],
    ];

    foreach ($kategoris as $kategori) {
        \App\Models\Kategori::create($kategori);
    }
}

    
}
