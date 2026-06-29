<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    // Tampilkan form buat pengaduan
    public function create()
    {
        $kategoris = Kategori::all();
        return view('siswa.pengaduan.create', compact('kategoris'));
    }

    // Simpan pengaduan ke database
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|max:255',
            'isi_pengaduan' => 'required|string',
            'bukti_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // Handle upload gambar
        if ($request->hasFile('bukti_gambar')) {
            $validated['bukti_gambar'] = $request->file('bukti_gambar')->store('bukti_pengaduan', 'public');
        }

        // Tambahkan user_id dan status
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        // Simpan ke database
        Pengaduan::create($validated);

        return redirect()->route('siswa.dashboard')
            ->with('success', 'Pengaduan berhasil dikirim! Tim kami akan segera memproses.');
    }

    // Lihat detail pengaduan
    public function show(Pengaduan $pengaduan)
    {
        // Pastikan hanya pemilik pengaduan yang bisa lihat
        if ($pengaduan->user_id !== auth()->id()) {
            abort(403);
        }

        return view('siswa.pengaduan.show', compact('pengaduan'));
    }
}