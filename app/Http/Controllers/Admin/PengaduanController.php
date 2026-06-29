<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::with(['user', 'kategori'])->latest()->get();
        return view('admin.pengaduan', compact('pengaduans'));
    }

    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load(['user', 'kategori', 'tanggapans.user']);
        return view('admin.pengaduan-detail', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai,ditolak'
        ]);
        $pengaduan->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Status pengaduan berhasil diperbarui!');
    }

    public function storeTanggapan(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string'
        ]);

        Tanggapan::create([
            'pengaduan_id' => $pengaduan->id,
            'user_id' => auth()->id(),
            'isi_tanggapan' => $request->isi_tanggapan
        ]);

        // Otomatis ubah status jadi selesai jika admin memberi tanggapan (opsional, tapi bagus untuk UX)
        // $pengaduan->update(['status' => 'selesai']); 

        return redirect()->back()->with('success', 'Tanggapan berhasil dikirim!');
    }
}