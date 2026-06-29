<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengaduan = Pengaduan::count();
        $pendingCount = Pengaduan::where('status', 'pending')->count();
        $prosesCount = Pengaduan::where('status', 'proses')->count();
        $selesaiCount = Pengaduan::where('status', 'selesai')->count();
        
        $recentPengaduans = Pengaduan::with(['user', 'kategori'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPengaduan', 'pendingCount', 'prosesCount', 'selesaiCount', 'recentPengaduans'
        ));
    }
}