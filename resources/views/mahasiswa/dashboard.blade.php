<x-mahasiswa-layout>
    <div class="space-y-6">
        <!-- Welcome Header -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Selamat Datang, {{ $mahasiswa->nama }}</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">NIM: {{ $mahasiswa->nim }} | Angkatan: {{ $mahasiswa->angkatan }}</p>
        </div>

        <!-- Status Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Status Pengajuan -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Status Pengajuan</p>
                        <h3 class="text-2xl font-bold mt-1
                            @if($statusPengajuan == 'disetujui') text-green-600
                            @elseif($statusPengajuan == 'pending') text-yellow-600
                            @elseif($statusPengajuan == 'ditolak') text-red-600
                            @else text-gray-600 @endif">
                            @if($statusPengajuan == 'disetujui') Disetujui
                            @elseif($statusPengajuan == 'pending') Menunggu Persetujuan
                            @elseif($statusPengajuan == 'ditolak') Ditolak
                            @else Belum Mengajukan
                            @endif
                        </h3>
                    </div>
                    <div class="p-3 
                        @if($statusPengajuan == 'disetujui') bg-green-100 dark:bg-green-900
                        @elseif($statusPengajuan == 'pending') bg-yellow-100 dark:bg-yellow-900
                        @elseif($statusPengajuan == 'ditolak') bg-red-100 dark:bg-red-900
                        @else bg-gray-100 dark:bg-gray-700 @endif
                        rounded-full">
                        <svg class="w-8 h-8 
                            @if($statusPengajuan == 'disetujui') text-green-600 dark:text-green-300
                            @elseif($statusPengajuan == 'pending') text-yellow-600 dark:text-yellow-300
                            @elseif($statusPengajuan == 'ditolak') text-red-600 dark:text-red-300
                            @else text-gray-600 dark:text-gray-400 @endif" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Dosen Pembimbing -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Dosen Pembimbing</p>
                        @if($dosenPembimbing)
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white mt-1">{{ $dosenPembimbing->nama }}</h3>
                            <p class="text-xs text-gray-500 mt-1">NIDN: {{ $dosenPembimbing->nidn }}</p>
                        @else
                            <h3 class="text-xl font-bold text-gray-600 dark:text-gray-400 mt-1">Belum Ditentukan</h3>
                        @endif
                    </div>
                    <div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @if($statusPengajuan == 'belum_mengajukan' || $statusPengajuan == 'ditolak')
                <a href="{{ url('/mahasiswa/pengajuan/create') }}" class="flex items-center p-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow transition">
                    <div class="p-2 bg-white/20 rounded-full mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <span class="font-medium text-sm">Ajukan Pembimbing</span>
                </a>
                @endif
                
                <a href="{{ url('/mahasiswa/pengajuan') }}" class="flex items-center p-4 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow transition">
                    <div class="p-2 bg-white/20 rounded-full mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <span class="font-medium text-sm">Lihat Riwayat Pengajuan</span>
                </a>

                <a href="{{ url('/profile') }}" class="flex items-center p-4 bg-purple-500 hover:bg-purple-600 text-white rounded-lg shadow transition">
                    <div class="p-2 bg-white/20 rounded-full mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <span class="font-medium text-sm">Update Profil</span>
                </a>
            </div>
        </div>

        <!-- Riwayat Pengajuan -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Riwayat Pengajuan</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Dosen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($riwayatPengajuan as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $item->dosen->nama ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->status == 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @elseif($item->status == 'disetujui')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                Belum ada riwayat pengajuan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-mahasiswa-layout>
