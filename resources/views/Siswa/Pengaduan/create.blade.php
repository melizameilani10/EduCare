<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengaduan - EduCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-blue-600 text-2xl mr-2"></i>
                    <span class="font-bold text-xl text-gray-800">EduCare</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('siswa.dashboard') }}" class="text-gray-700 hover:text-blue-600">Kembali ke Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md text-sm hover:bg-red-600">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Buat Pengaduan Baru</h1>
            <p class="text-gray-600 mt-2">Isi form di bawah untuk menyampaikan pengaduan Anda</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('siswa.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Kategori -->
                <div class="mb-6">
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori Pengaduan <span class="text-red-500">*</span></label>
                    <select name="kategori_id" id="kategori_id" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kategori_id') border-red-500 @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Judul -->
                <div class="mb-6">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Pengaduan <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                        placeholder="Contoh: AC di Kelas XII IPA 1 Rusak"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('judul') border-red-500 @enderror">
                    @error('judul')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Isi Pengaduan -->
                <div class="mb-6">
                    <label for="isi_pengaduan" class="block text-sm font-medium text-gray-700 mb-2">Isi Pengaduan <span class="text-red-500">*</span></label>
                    <textarea name="isi_pengaduan" id="isi_pengaduan" rows="5" required
                        placeholder="Jelaskan detail pengaduan Anda secara lengkap..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('isi_pengaduan') border-red-500 @enderror">{{ old('isi_pengaduan') }}</textarea>
                    @error('isi_pengaduan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload Bukti -->
                <div class="mb-6">
                    <label for="bukti_gambar" class="block text-sm font-medium text-gray-700 mb-2">Upload Bukti Foto (Opsional)</label>
                    <input type="file" name="bukti_gambar" id="bukti_gambar" accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('bukti_gambar') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG. Maksimal 2MB</p>
                    @error('bukti_gambar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('siswa.dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Kirim Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>