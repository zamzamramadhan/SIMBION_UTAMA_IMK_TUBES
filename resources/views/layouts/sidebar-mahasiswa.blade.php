<div class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-screen flex flex-col">
    <!-- Branding -->
    <div class="h-16 flex items-center justify-center border-b border-gray-200 dark:border-gray-700">
        <a href="{{ url('/mahasiswa/dashboard') }}" class="flex items-center gap-2">
            <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-xl font-serif italic">
                W
            </div>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
        
        <!-- Dashboard -->
        <a href="{{ url('/mahasiswa/dashboard') }}" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors group 
           {{ request()->is('mahasiswa/dashboard') ? 'bg-orange-400 text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->is('mahasiswa/dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            Dashboard
        </a>

        <!-- Pengajuan Pembimbing -->
        <a href="{{ url('/mahasiswa/pengajuan') }}" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors group text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Pengajuan Pembimbing
        </a>

        <!-- Daftar Dosen -->
        <a href="#" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors group text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 opacity-50 cursor-not-allowed">
            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            Daftar Dosen
        </a>

        <!-- Profile -->
        <a href="{{ url('/profile') }}" 
           class="flex items-center px-4 py-3 text-sm font-medium rounded-md transition-colors group text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            Profil Saya
        </a>
    </nav>
</div>
