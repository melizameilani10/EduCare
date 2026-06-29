<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCare - Sistem Pengaduan Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-md fixed w-full z-10 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-blue-600 text-2xl mr-2"></i>
                    <span class="font-bold text-xl text-gray-800">EduCare</span>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Dashboard Admin</a>
                        @else
                            <a href="{{ route('siswa.dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Dashboard Siswa</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md text-sm hover:bg-red-600">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700">Daftar Akun</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="pt-32 pb-20 bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-6">
                Sampaikan Keluhanmu, <br> <span class="text-blue-600">Wujudkan Sekolah Lebih Baik!</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                EduCare adalah platform resmi untuk menyampaikan aspirasi, keluhan, dan saran terkait lingkungan sekolah secara aman, transparan, dan solutif.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-blue-700 shadow-lg transition transform hover:-translate-y-1">
                    Buat Pengaduan Sekarang
                </a>
                <a href="#cara-kerja" class="bg-white text-blue-600 border border-blue-600 px-8 py-3 rounded-full text-lg font-semibold hover:bg-blue-50 transition">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <!-- FITUR UNGGULAN -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Kenapa Menggunakan EduCare?</h2>
                <p class="mt-4 text-gray-600">Platform pengaduan yang aman, cepat, dan ditanggapi langsung oleh pihak sekolah.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Fitur 1 -->
                <div class="bg-gray-50 p-8 rounded-xl shadow-sm hover:shadow-md transition text-center">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Aman & Rahasia</h3>
                    <p class="text-gray-600">Identitas pelapor dijaga kerahasiaannya. Laporkan masalah tanpa rasa takut.</p>
                </div>
                <!-- Fitur 2 -->
                <div class="bg-gray-50 p-8 rounded-xl shadow-sm hover:shadow-md transition text-center">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bolt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Respon Cepat</h3>
                    <p class="text-gray-600">Pengaduan langsung diteruskan ke petugas terkait untuk segera ditindaklanjuti.</p>
                </div>
                <!-- Fitur 3 -->
                <div class="bg-gray-50 p-8 rounded-xl shadow-sm hover:shadow-md transition text-center">
                    <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Pantau Status</h3>
                    <p class="text-gray-600">Lihat progress pengaduanmu secara real-time, dari pending hingga selesai.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CARA KERJA -->
    <section id="cara-kerja" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Cara Kerja Pengaduan</h2>
                <p class="mt-4 text-gray-600">Hanya 3 langkah mudah untuk menyuarakan aspirasimu.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="text-5xl font-bold text-blue-200 mb-4">01</div>
                    <h3 class="text-xl font-bold mb-2">Daftar & Login</h3>
                    <p class="text-gray-600">Buat akun menggunakan email dan NIS siswa kamu.</p>
                </div>
                <div>
                    <div class="text-5xl font-bold text-blue-200 mb-4">02</div>
                    <h3 class="text-xl font-bold mb-2">Isi Form Pengaduan</h3>
                    <p class="text-gray-600">Tuliskan keluhan, pilih kategori, dan lampirkan foto bukti jika ada.</p>
                </div>
                <div>
                    <div class="text-5xl font-bold text-blue-200 mb-4">03</div>
                    <h3 class="text-xl font-bold mb-2">Terima Tanggapan</h3>
                    <p class="text-gray-600">Admin akan memverifikasi dan memberikan solusi/tanggapan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400">&copy; 2026 EduCare - Sistem Pengaduan Siswa. Dibuat dengan Laravel 12.</p>
        </div>
    </footer>

</body>
</html>