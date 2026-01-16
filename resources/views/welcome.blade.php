<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMBION - Sistem Informasi Bimbingan Online</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="antialiased text-slate-600 bg-slate-50 selection:bg-indigo-500 selection:text-white overflow-x-hidden">
    
    <!-- Background Decoration -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-200/20 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-200/20 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-50 max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
        <div class="flex items-center gap-3 group cursor-pointer">
            <div class="relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-200"></div>
                <img src="{{ asset('images/logo-simbion.png') }}" alt="SIMBION" class="relative block h-10 w-auto bg-white rounded-lg p-1">
            </div>
            <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">SIMBION UTAMA</span>
        </div>
        
        <div class="flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-white text-slate-700 font-semibold rounded-xl border border-slate-200 shadow-sm hover:shadow-md hover:border-indigo-200 hover:text-indigo-600 transition-all duration-300">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2.5 text-slate-600 font-semibold hover:text-indigo-600 transition-colors">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="group relative px-6 py-2.5 bg-slate-900 text-white font-semibold rounded-xl overflow-hidden shadow-lg hover:shadow-indigo-500/30 transition-all duration-300">
                            <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <span class="relative">Daftar Sekarang</span>
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative z-10 max-w-5xl mx-auto px-6 pt-24 pb-32 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-slate-200 shadow-sm mb-8 animate-fade-in-up">
            <span class="flex h-2 w-2 rounded-full bg-indigo-500 animate-pulse"></span>
            <span class="text-sm font-medium text-slate-600">Sistem Akademik Terintegrasi</span>
        </div>
        
        <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 mb-8 leading-tight tracking-tight">
            Sistem Bimbingan Online <br class="hidden md:block">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-blue-600 to-indigo-600">Widyatama</span>
        </h1>
        
        <p class="text-lg md:text-xl text-slate-500 mb-12 max-w-2xl mx-auto leading-relaxed">
            Platform modern untuk menghubungkan mahasiswa dan dosen dalam proses bimbingan akademik yang efisien dan transparan.
        </p>
        
        @guest
            <div class="flex flex-col sm:flex-row gap-5 justify-center items-center">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-500/20 hover:bg-indigo-700 hover:shadow-2xl hover:shadow-indigo-500/30 hover:-translate-y-1 transition-all duration-300">
                    Mulai Bimbingan
                </a>
                <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-white text-slate-700 rounded-2xl font-bold text-lg border border-slate-200 shadow-lg shadow-slate-200/50 hover:border-indigo-200 hover:text-indigo-600 hover:-translate-y-1 transition-all duration-300">
                    Masuk Akun
                </a>
            </div>
        @else
            <a href="{{ url('/dashboard') }}" class="inline-block px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-500/20 hover:bg-indigo-700 hover:shadow-2xl hover:shadow-indigo-500/30 hover:-translate-y-1 transition-all duration-300">
                Kembali ke Dashboard
            </a>
        @endguest
    </main>

    <!-- Stats/Features -->
    <section class="relative z-10 max-w-7xl mx-auto px-6 py-16">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="group p-8 bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-indigo-100 hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 text-indigo-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Manajemen Dosen</h3>
                <p class="text-slate-500 leading-relaxed">Sistem pintar pengelolaan kuota dan plotting dosen pembimbing secara otomatis.</p>
            </div>
            
            <div class="group p-8 bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-blue-100 hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 text-blue-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Pengajuan Digital</h3>
                <p class="text-slate-500 leading-relaxed">Paperless. Ajukan judul dan proposal skripsi Anda dari mana saja.</p>
            </div>
            
            <div class="group p-8 bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-indigo-100 hover:-translate-y-1 transition-all duration-300">
                <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 text-indigo-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3">Real-time Monitoring</h3>
                <p class="text-slate-500 leading-relaxed">Pantau status persetujuan dan riwayat bimbingan secara langsung.</p>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="relative z-10 max-w-7xl mx-auto px-6 py-24">
        <div class="text-center mb-16">
            <span class="text-indigo-600 font-bold tracking-wider uppercase text-sm">Tim Pengembang</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mt-2">Meet The Builders</h2>
        </div>
        
        <div class="grid md:grid-cols-3 gap-10">
            <!-- Member 1 -->
            <div class="group relative bg-white rounded-[2rem] p-10 text-center shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-indigo-200/50 hover:-translate-y-2 transition-all duration-500">
                <div class="absolute inset-x-0 top-0 h-32 bg-gradient-to-br from-indigo-50 to-blue-50 rounded-t-[2rem]"></div>
                <div class="relative w-32 h-32 mx-auto mb-6 p-1 bg-white rounded-full shadow-lg group-hover:scale-105 transition-transform duration-500">
                    <img src="https://ui-avatars.com/api/?name=Moch+Zamzam&background=6366f1&color=fff&size=128" alt="Moch Zamzam" class="w-full h-full rounded-full object-cover">
                </div>
                <div class="relative">
                    <h3 class="text-2xl font-bold text-slate-900 mb-1 group-hover:text-indigo-600 transition-colors">Moch Zamzam</h3>
                    <p class="text-indigo-500 font-medium mb-4">Lead Developer</p>
                    <div class="inline-block px-4 py-1.5 bg-slate-50 rounded-full border border-slate-100 text-sm text-slate-500 font-mono">
                        NIM: 40622190002
                    </div>
                </div>
            </div>

            <!-- Member 2 -->
            <div class="group relative bg-white rounded-[2rem] p-10 text-center shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-purple-200/50 hover:-translate-y-2 transition-all duration-500">
                <div class="absolute inset-x-0 top-0 h-32 bg-gradient-to-br from-purple-50 to-pink-50 rounded-t-[2rem]"></div>
                <div class="relative w-32 h-32 mx-auto mb-6 p-1 bg-white rounded-full shadow-lg group-hover:scale-105 transition-transform duration-500">
                    <img src="https://ui-avatars.com/api/?name=Crucita&background=a855f7&color=fff&size=128" alt="Crucita" class="w-full h-full rounded-full object-cover">
                </div>
                <div class="relative">
                    <h3 class="text-2xl font-bold text-slate-900 mb-1 group-hover:text-purple-600 transition-colors">Crucita</h3>
                    <p class="text-purple-500 font-medium mb-4">UI/UX Designer</p>
                    <div class="inline-block px-4 py-1.5 bg-slate-50 rounded-full border border-slate-100 text-sm text-slate-500 font-mono">
                        NIM: 4022XXXXX
                    </div>
                </div>
            </div>

            <!-- Member 3 -->
            <div class="group relative bg-white rounded-[2rem] p-10 text-center shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-teal-200/50 hover:-translate-y-2 transition-all duration-500">
                <div class="absolute inset-x-0 top-0 h-32 bg-gradient-to-br from-teal-50 to-emerald-50 rounded-t-[2rem]"></div>
                <div class="relative w-32 h-32 mx-auto mb-6 p-1 bg-white rounded-full shadow-lg group-hover:scale-105 transition-transform duration-500">
                    <img src="https://ui-avatars.com/api/?name=Aulia&background=14b8a6&color=fff&size=128" alt="Aulia" class="w-full h-full rounded-full object-cover">
                </div>
                <div class="relative">
                    <h3 class="text-2xl font-bold text-slate-900 mb-1 group-hover:text-teal-600 transition-colors">Aulia</h3>
                    <p class="text-teal-500 font-medium mb-4">Database</p>
                    <div class="inline-block px-4 py-1.5 bg-slate-50 rounded-full border border-slate-100 text-sm text-slate-500 font-mono">
                        NIM: 4022XXXXX
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative z-10 bg-white border-t border-slate-100 py-12">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3 opacity-75 grayscale hover:grayscale-0 transition-all duration-300">
                <img src="{{ asset('images/logo-simbion.png') }}" alt="SIMBION" class="h-8">
                <span class="font-bold text-slate-700">SIMBION UTAMA</span>
            </div>
            
            <p class="text-slate-500 text-sm">
                &copy; {{ date('Y') }} SIMBION. Universitas Widyatama.
            </p>
            
            <div class="flex gap-6 text-sm font-medium text-slate-500">
                <a href="#" class="hover:text-indigo-600 transition-colors">Documentation</a>
                <a href="#" class="hover:text-indigo-600 transition-colors">Support</a>
                <a href="#" class="hover:text-indigo-600 transition-colors">Privacy</a>
            </div>
        </div>
    </footer>
</body>
</html>
