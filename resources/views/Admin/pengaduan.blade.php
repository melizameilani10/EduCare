<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pengaduan - EduCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    <nav class="bg-white shadow-md mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-user-shield text-blue-600 text-2xl mr-2"></i>
                    <span class="font-bold text-xl text-gray-800">EduCare Admin</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                    <a href="{{ route('admin.pengaduan') }}" class="text-blue-600 font-semibold">Pengaduan</a>
                    <a href="{{ route('admin.kategori') }}" class="text-gray-700 hover:text-blue-600">Kategori</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md text-sm hover:bg-red-600">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Daftar Semua Pengaduan</h1>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pengaduans as $p)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $p->judul }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $p->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $p->kategori->nama_kategori }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $p->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    {{ $p->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($p->status == 'selesai' ? 'bg-green-100 text-green-800' : ($p->status == 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800')) }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.pengaduan.show', $p) }}" class="text-blue-600 hover:text-blue-900">Detail & Tanggapi</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada data pengaduan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>