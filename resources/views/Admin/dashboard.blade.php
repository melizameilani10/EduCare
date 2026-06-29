<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - EduCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-user-shield text-blue-600 text-2xl mr-2"></i>
                    <span class="font-bold text-xl text-gray-800">EduCare Admin</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                    <a href="{{ route('admin.pengaduan') }}" class="text-gray-700 hover:text-blue-600">Pengaduan</a>
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
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Dashboard Admin</h1>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                <p class="text-gray-500 text-sm">Total Pengaduan</p>
                <p class="text-3xl font-bold text-gray-900">{{ $totalPengaduan }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-500">
                <p class="text-gray-500 text-sm">Pending</p>
                <p class="text-3xl font-bold text-gray-900">{{ $pendingCount }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
                <p class="text-gray-500 text-sm">Diproses</p>
                <p class="text-3xl font-bold text-gray-900">{{ $prosesCount }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
                <p class="text-gray-500 text-sm">Selesai</p>
                <p class="text-3xl font-bold text-gray-900">{{ $selesaiCount }}</p>
            </div>
        </div>

        <!-- Recent Complaints -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-bold text-gray-900">Pengaduan Terbaru</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelapor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentPengaduans as $p)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $p->judul }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $p->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $p->kategori->nama_kategori }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $p->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($p->status == 'selesai' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('admin.pengaduan.show', $p) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>