<x-dosen-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengajuan Kuota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex justify-between items-center">
                <div class="text-gray-900 dark:text-gray-100">
                    Kuota Saat Ini: <span class="font-bold text-2xl">{{ $dosen->kuota }}</span>
                </div>
                <a href="{{ route('dosen.pengajuan.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Ajukan Tambahan Kuota
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-bold text-lg mb-4">Riwayat Pengajuan</h3>
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Jumlah Diajukan</th>
                                <th class="px-6 py-4">Alasan</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Catatan Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengajuans as $p)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">{{ $p->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 font-bold">+{{ $p->jumlah }}</td>
                                <td class="px-6 py-4 truncate max-w-xs">{{ $p->alasan }}</td>
                                <td class="px-6 py-4">
                                     @if($p->status == 'pending')
                                        <span class="px-2 py-1 rounded bg-yellow-500 text-white">Pending</span>
                                    @elseif($p->status == 'disetujui')
                                        <span class="px-2 py-1 rounded bg-green-500 text-white">Disetujui</span>
                                    @else
                                        <span class="px-2 py-1 rounded bg-red-500 text-white">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-500 italic">{{ $p->catatan ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada riwayat pengajuan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-dosen-layout>
