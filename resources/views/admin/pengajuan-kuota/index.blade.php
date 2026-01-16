<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Monitoring Pengajuan Kuota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                <p class="font-bold">Informasi</p>
                <p class="text-sm">Approval pengajuan kuota dilakukan oleh <strong>Kaprodi</strong>. Admin hanya dapat melihat data untuk monitoring.</p>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Dosen</th>
                                <th class="px-6 py-4">Jumlah</th>
                                <th class="px-6 py-4">Alasan</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengajuans as $p)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">{{ $p->created_at->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 font-bold">{{ $p->dosen->nama }} <br> <span class="text-xs font-normal text-gray-500">Kuota Saat Ini: {{ $p->dosen->kuota }}</span></td>
                                <td class="px-6 py-4 text-lg font-bold text-blue-600">+{{ $p->jumlah }}</td>
                                <td class="px-6 py-4 whitespace-normal max-w-sm">{{ $p->alasan }}</td>
                                <td class="px-6 py-4">
                                     @if($p->status == 'pending')
                                        <span class="px-2 py-1 rounded bg-yellow-500 text-white">Pending</span>
                                    @elseif($p->status == 'disetujui')
                                        <span class="px-2 py-1 rounded bg-green-500 text-white">Disetujui</span>
                                    @else
                                        <span class="px-2 py-1 rounded bg-red-500 text-white">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-500">{{ $p->catatan ?? '-' }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                     <div class="mt-4">
                        {{ $pengajuans->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
