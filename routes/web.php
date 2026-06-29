<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Landing Page (Bisa diakses semua orang)
Route::get('/', function () {
    return view('landing'); // Nanti kita buat file ini di Tahap 5
})->name('home');

// 2. Route Breeze (Login, Register, Profile)
require __DIR__.'/auth.php';

// 3. Route untuk SISWA
// 3. Route untuk SISWA
Route::middleware(['auth', 'verified', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Siswa\DashboardController::class, 'index'])->name('dashboard');
    
    // Resource route untuk pengaduan (create, store, show)
    Route::get('/pengaduan/buat', [\App\Http\Controllers\Siswa\PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [\App\Http\Controllers\Siswa\PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/{pengaduan}', [\App\Http\Controllers\Siswa\PengaduanController::class, 'show'])->name('pengaduan.show');
});;

// 4. Route untuk ADMIN
// 4. Route untuk ADMIN
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Kategori
    Route::get('/kategori', [\App\Http\Controllers\Admin\KategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori', [\App\Http\Controllers\Admin\KategoriController::class, 'store'])->name('kategori.store');
    Route::delete('/kategori/{kategori}', [\App\Http\Controllers\Admin\KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Pengaduan
    Route::get('/pengaduan', [\App\Http\Controllers\Admin\PengaduanController::class, 'index'])->name('pengaduan');
    Route::get('/pengaduan/{pengaduan}', [\App\Http\Controllers\Admin\PengaduanController::class, 'show'])->name('pengaduan.show');
    Route::patch('/pengaduan/{pengaduan}/status', [\App\Http\Controllers\Admin\PengaduanController::class, 'updateStatus'])->name('pengaduan.status');
    Route::post('/pengaduan/{pengaduan}/tanggapan', [\App\Http\Controllers\Admin\PengaduanController::class, 'storeTanggapan'])->name('pengaduan.tanggapan');
});
// 5. Redirect setelah Login (Sesuai Role)
// Kita akan atur ini di file AuthController Breeze, tapi untuk sementara 
// kita bisa pakai Event Listener atau modifikasi LoginResponse.