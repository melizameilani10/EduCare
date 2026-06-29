<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua pengaduan milik siswa yang sedang login
        $pengaduans = Pengaduan::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung statistik
        $totalPengaduan = $pengaduans->count();
        $pendingCount = $pengaduans->where('status', 'pending')->count();
        $prosesCount = $pengaduans->where('status', 'proses')->count();
        $selesaiCount = $pengaduans->where('status', 'selesai')->count();

        return view('siswa.dashboard', compact(
            'pengaduans',
            'totalPengaduan',
            'pendingCount',
            'prosesCount',
            'selesaiCount'
        ));
    }
}