<x-admin-layout>
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Jumlah Dosen -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
            <div class="flex items-center gap-4 mb-2">
                <div class="p-2 bg-indigo-50 rounded text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-900 dark:text-gray-100">Jumlah Dosen</h3>
            </div>
            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 text-center mb-4">{{ $totalDosen }}</div>
            <div class="flex justify-center gap-4 text-xs text-gray-500">
                <span class="flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span> {{ $dosenAktif }} Aktif
                </span>
                <span class="flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span> {{ $dosenNonaktif }} NonAktif
                </span>
            </div>
        </div>

        <!-- Total Mahasiswa -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
             <div class="flex items-center gap-4 mb-2">
                <div class="p-2 bg-blue-50 rounded text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-900 dark:text-gray-100">Total Mahasiswa</h3>
            </div>
            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 text-center mb-4">{{ $totalMahasiswa }}</div>
             <p class="text-center text-xs text-gray-500">Mahasiswa Terdaftar</p>
        </div>

        <!-- Aktif Bimbingan -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
             <div class="flex items-center gap-4 mb-2">
                <div class="p-2 bg-green-50 rounded text-green-600">
                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-900 dark:text-gray-100">Aktif Bimbingan</h3>
            </div>
            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 text-center mb-4">{{ $bimbinganAktif }}</div>
             <p class="text-center text-xs text-gray-500">Sesi Sedang Berjalan</p>
        </div>

        <!-- Pending Kuota -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
             <div class="flex items-center gap-4 mb-2">
                <div class="p-2 bg-red-50 rounded text-red-600">
                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-medium text-gray-900 dark:text-gray-100">Pending Kuota</h3>
            </div>
            <div class="text-4xl font-bold text-gray-900 dark:text-gray-100 text-center mb-4">{{ $pendingKuota }}</div>
             <p class="text-center text-xs text-gray-500">Need Action</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mb-8">
        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ url('/admin/pengajuan-kuota') }}" class="flex items-center p-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow transition">
                <div class="p-2 bg-white/20 rounded-full mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="font-medium text-lg w-full text-center">Approval pengajuan kuota</span>
            </a>
            
            <a href="#" class="flex items-center p-4 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow transition">
                 <div class="p-2 bg-white/20 rounded-full mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <span class="font-medium text-lg w-full text-center">Lihat pengajuan mendesak</span>
            </a>

            <a href="{{ url('/admin/laporan') }}" class="flex items-center p-4 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow transition">
                 <div class="p-2 bg-white/20 rounded-full mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <span class="font-medium text-lg w-full text-center">Generate laporan cepat</span>
            </a>

            <a href="{{ url('/admin/laporan/export/mahasiswa') }}" class="flex items-center p-4 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow transition">
                 <div class="p-2 bg-white/20 rounded-full mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-7a2 2 0 012-2h2m3-4H9a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-1m-1 4l-3 3m0 0l-3-3m3 3V3"></path></svg>
                </div>
                <span class="font-medium text-lg w-full text-center">Export data</span>
            </a>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Aktivitas Terbaru</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-gray-500 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-4 py-3 font-medium">Jenis</th>
                        <th class="px-4 py-3 font-medium">Detail</th>
                        <th class="px-4 py-3 font-medium">Waktu</th>
                        <th class="px-4 py-3 font-medium text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($aktivitas as $log)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-4 py-3 text-blue-500">{{ $log->jenis }}</td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $log->detail }}</td>
                        <td class="px-4 py-3 text-blue-400">{{ $log->created_at->diffForHumans() }}</td>
                        <td class="px-4 py-3 text-right">
                            @php
                                $statusColor = match(strtolower($log->status)) {
                                    'pending', 'need approval' => 'bg-yellow-400 text-white',
                                    'approved', 'approval', 'disetujui' => 'bg-green-500 text-white',
                                    'new' => 'bg-sky-500 text-white',
                                    'info' => 'bg-gray-400 text-white',
                                    'rejected', 'ditolak' => 'bg-red-500 text-white',
                                    default => 'bg-gray-200 text-gray-600'
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                                {{ $log->status ?? 'Info' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada aktivitas terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
