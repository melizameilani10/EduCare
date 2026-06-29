<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pengaduan - EduCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navbar (Sama seperti dashboard) -->
    <nav class="bg-white shadow-md mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center"><span class="font-bold text-xl">EduCare Admin</span></div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-700">Dashboard</a>
                    <a href="{{ route('admin.pengaduan') }}" class="text-gray-700">Pengaduan</a>
                    <form method="POST" action="{{ route('logout') }}">@csrf<button class="bg-red-500 text-white px-4 py-2 rounded-md text-sm">Logout</button></form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-4 py-8">
        <a href="{{ route('admin.pengaduan') }}" class="text-blue-600 mb-4 inline-block">&larr; Kembali ke Daftar Pengaduan</a>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Info Pengaduan -->
            <div class="md:col-span-2 bg-white p-6 rounded-lg shadow">
                <h1 class="text-2xl font-bold mb-2">{{ $pengaduan->judul }}</h1>
                <div class="text-sm text-gray-500 mb-4">
                    Dilaporkan oleh: <strong>{{ $pengaduan->user->name }}</strong> | 
                    Kategori: <strong>{{ $pengaduan->kategori->nama_kategori }}</strong> | 
                    Tanggal: {{ $pengaduan->created_at->format('d M Y H:i') }}
                </div>
                <hr class="my-4">
                <p class="text-gray-700 whitespace-pre-line">{{ $pengaduan->isi_pengaduan }}</p>
                
                @if($pengaduan->bukti_gambar)
                    <div class="mt-4">
                        <p class="font-semibold mb-2">Bukti Foto:</p>
                        <img src="{{ asset('storage/' . $pengaduan->bukti_gambar) }}" class="max-w-full h-auto rounded-lg border">
                    </div>
                @endif
            </div>

            <!-- Aksi Admin -->
            <div class="space-y-6">
                <!-- Ubah Status -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="font-bold text-lg mb-4">Ubah Status</h3>
                    <form action="{{ route('admin.pengaduan.status', $pengaduan) }}" method="POST">
                        @csrf @method('PATCH')
                        <select name="status" class="w-full border-gray-300 rounded-md shadow-sm mb-3">
                            <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">Update Status</button>
                    </form>
                </div>

                <!-- Beri Tanggapan -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="font-bold text-lg mb-4">Beri Tanggapan</h3>
                    <form action="{{ route('admin.pengaduan.tanggapan', $pengaduan) }}" method="POST">
                        @csrf
                        <textarea name="isi_tanggapan" rows="4" class="w-full border-gray-300 rounded-md shadow-sm mb-3" placeholder="Tulis tanggapan Anda..."></textarea>
                        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700">Kirim Tanggapan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Riwayat Tanggapan -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow">
            <h3 class="font-bold text-lg mb-4">Riwayat Tanggapan</h3>
            @if($pengaduan->tanggapans->count() > 0)
                @foreach($pengaduan->tanggapans as $tanggapan)
                    <div class="border-b py-4 last:border-0">
                        <div class="flex justify-between text-sm text-gray-500 mb-1">
                            <span>{{ $tanggapan->user->name }}</span>
                            <span>{{ $tanggapan->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <p class="text-gray-700">{{ $tanggapan->isi_tanggapan }}</p>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500">Belum ada tanggapan.</p>
            @endif
        </div>
    </div>
</body>
</html>