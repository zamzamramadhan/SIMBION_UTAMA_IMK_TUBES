<x-kaprodi-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan Program Bimbingan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Dosen Aktif</p>
                    <h3 class="text-3xl font-bold text-blue-600 mt-2">{{ $totalDosen }}</h3>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Mahasiswa Aktif</p>
                    <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $totalMahasiswa }}</h3>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Bimbingan Aktif</p>
                    <h3 class="text-3xl font-bold text-purple-600 mt-2">{{ $totalBimbinganAktif }}</h3>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Mahasiswa Belum Dapat Pembimbing</p>
                    <h3 class="text-3xl font-bold text-red-600 mt-2">{{ $mahasiswaBelumPembimbing }}</h3>
                </div>
            </div>

            <!-- Kuota Utilization -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Utilisasi Kuota Program</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Kuota</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $totalKuota }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Terpakai</p>
                        <p class="text-2xl font-bold text-green-600">{{ $kuotaTerpakai }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Tersisa</p>
                        <p class="text-2xl font-bold text-orange-600">{{ $kuotaTersisa }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Utilisasi</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $persentaseUtilisasi }}%</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="w-full bg-gray-200 rounded-full h-6">
                        <div class="bg-gradient-to-r from-green-500 to-blue-500 h-6 rounded-full flex items-center justify-center text-white text-xs font-semibold" 
                             style="width: {{ $persentaseUtilisasi }}%">
                            {{ $persentaseUtilisasi }}%
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengajuan Statistics -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Statistik Pengajuan</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Disetujui</p>
                        <p class="text-3xl font-bold text-green-600">{{ $totalBimbinganAktif }}</p>
                    </div>
                    <div class="text-center p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Pending</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $pengajuanPending }}</p>
                    </div>
                    <div class="text-center p-4 bg-red-50 dark:bg-red-900/20 rounded">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Ditolak</p>
                        <p class="text-3xl font-bold text-red-600">{{ $pengajuanDitolak }}</p>
                    </div>
                </div>
            </div>

            <!-- Top 5 Dosen dengan Bimbingan Terbanyak -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Top 5 Dosen - Bimbingan Terbanyak</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Nama Dosen</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">NIDN</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Kuota</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Bimbingan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($dosenTopBimbingan as $index => $dosen)
                            <tr>
                                <td class="px-6 py-4 text-sm font-bold text-gray-900 dark:text-gray-100">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $dosen->nama }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $dosen->nidn }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $dosen->kuota }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="font-bold text-blue-600">{{ $dosen->total_bimbingan }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Aktivitas Terbaru (10 Terakhir)</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Mahasiswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Dosen</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($aktivitasTerbaru as $aktivitas)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $aktivitas->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $aktivitas->mahasiswa->nama ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                    {{ $aktivitas->dosen->nama ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($aktivitas->status == 'pending')
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @elseif($aktivitas->status == 'disetujui')
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Disetujui</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada aktivitas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-kaprodi-layout>
