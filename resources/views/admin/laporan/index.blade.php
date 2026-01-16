<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan & Statistik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Quick Export Buttons -->
            <div class="flex flex-wrap gap-4 mb-6">
                <a href="{{ route('admin.laporan.export.mahasiswa') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Export Data Mahasiswa (CSV)
                </a>
                <a href="{{ route('admin.laporan.export.bimbingan') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                     Export Semua Bimbingan (CSV)
                </a>
                 <a href="{{ route('admin.laporan.print') }}" target="_blank" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                     Print Laporan Resmi (PDF View)
                </a>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Line Chart: Monthly Trend -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Trend Pengajuan Tahun Ini</h3>
                    <canvas id="trendChart"></canvas>
                </div>
                <!-- Pie Chart: Status Bimbingan -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                     <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Status Proposal Bimbingan</h3>
                    <canvas id="statusChart"></canvas>
                </div>
            </div>

            <!-- Top Dosen Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Top 5 Dosen Terpopuler</h3>
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4">Nama Dosen</th>
                                <th class="px-6 py-4">Total Requests</th>
                                <th class="px-6 py-4">Status Kuota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topDosens as $dosen)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 font-bold">{{ $dosen->nama }}</td>
                                <td class="px-6 py-4 text-blue-600 font-bold">{{ $dosen->total_requests }}</td>
                                <td class="px-6 py-4">{{ $dosen->kuota }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Trend Line Chart
            new Chart(document.getElementById('trendChart'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Jumlah Pengajuan',
                        data: @json($chartData),
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1,
                        fill: false
                    }]
                },
                options: { responsive: true }
            });

            // Status Pie Chart
            new Chart(document.getElementById('statusChart'), {
                type: 'pie',
                data: {
                    labels: ['Pending', 'Disetujui', 'Ditolak'],
                    datasets: [{
                        data: [{{ $stats['pending'] }}, {{ $stats['disetujui'] }}, {{ $stats['ditolak'] }}],
                        backgroundColor: ['#eab308', '#22c55e', '#ef4444']
                    }]
                },
                options: { responsive: true }
            });
        });
    </script>
</x-admin-layout>
