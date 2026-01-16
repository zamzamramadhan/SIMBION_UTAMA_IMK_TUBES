<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Monitoring Kuota Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Charts Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Bar Chart: Top 5 Utilization -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                    <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Top Utilization</h3>
                    <canvas id="utilizationChart"></canvas>
                </div>
                <!-- Pie Chart: Distribution -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                     <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-gray-100">Status Kuota</h3>
                    <canvas id="statusChart"></canvas>
                </div>
            </div>

            <!-- Monitoring Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Detail Kuota Dosen</h3>
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4">Dosen</th>
                                <th class="px-6 py-4">Skills</th>
                                <th class="px-6 py-4">Kuota</th>
                                <th class="px-6 py-4">Terpakai</th>
                                <th class="px-6 py-4">Sisa</th>
                                <th class="px-6 py-4">Utilization</th>
                                <th class="px-6 py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dosens as $dosen)
                            @php
                                $rowClass = '';
                                $badgeClass = 'bg-blue-100 text-blue-800';
                                if($dosen->utilization >= 100) {
                                    $rowClass = 'bg-red-50 dark:bg-red-900/20';
                                    $badgeClass = 'bg-red-500 text-white';
                                } elseif($dosen->utilization >= 80) {
                                    $rowClass = 'bg-yellow-50 dark:bg-yellow-900/20';
                                    $badgeClass = 'bg-yellow-500 text-white';
                                }
                            @endphp
                            <tr class="border-b dark:border-gray-700 {{ $rowClass }} hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 font-bold">{{ $dosen->nama }}</td>
                                <td class="px-6 py-4">
                                     <div class="flex flex-wrap gap-1">
                                    @foreach($dosen->skills->take(3) as $skill)
                                        <span class="text-xs px-2 py-0.5 bg-gray-200 dark:bg-gray-700 rounded">{{ $skill->name }}</span>
                                    @endforeach
                                    @if($dosen->skills->count() > 3)
                                        <span class="text-xs px-2 py-0.5 bg-gray-200 dark:bg-gray-700 rounded">+{{ $dosen->skills->count() - 3 }}</span>
                                    @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">{{ $dosen->kuota }}</td>
                                <td class="px-6 py-4 text-center">{{ $dosen->terpakai }}</td>
                                <td class="px-6 py-4 text-center font-bold">{{ $dosen->sisa }}</td>
                                <td class="px-6 py-4">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ min($dosen->utilization, 100) }}%"></div>
                                    </div>
                                    <span class="text-xs">{{ $dosen->utilization }}%</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-xs {{ $badgeClass }}">
                                        @if($dosen->utilization >= 100) Penuh
                                        @elseif($dosen->utilization >= 80) Padat
                                        @else Tersedia
                                        @endif
                                    </span>
                                </td>
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
            const dosens = @json($dosens->take(5)->pluck('nama'));
            const dataUsed = @json($dosens->take(5)->pluck('terpakai'));
            const dataQuota = @json($dosens->take(5)->pluck('kuota'));
            
            // Stats for Pie Chart
            const full = {{ $dosens->where('utilization', '>=', 100)->count() }};
            const warning = {{ $dosens->where('utilization', '>=', 80)->where('utilization', '<', 100)->count() }};
            const open = {{ $dosens->where('utilization', '<', 80)->count() }};

            // Bar Chart
            new Chart(document.getElementById('utilizationChart'), {
                type: 'bar',
                data: {
                    labels: dosens,
                    datasets: [{
                        label: 'Terpakai',
                        data: dataUsed,
                         backgroundColor: 'rgba(54, 162, 235, 0.6)'
                    },
                    {
                        label: 'Kapasitas Total',
                        data: dataQuota,
                         backgroundColor: 'rgba(201, 203, 207, 0.4)'
                    }]
                },
                options: {
                    responsive: true,
                    scales: { y: { beginAtZero: true } }
                }
            });

            // Pie Chart
            new Chart(document.getElementById('statusChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Penuh (>100%)', 'Padat (>80%)', 'Tersedia'],
                    datasets: [{
                        data: [full, warning, open],
                        backgroundColor: ['#ef4444', '#eab308', '#22c55e']
                    }]
                },
                options: { responsive: true }
            });
        });
    </script>
</x-admin-layout>
