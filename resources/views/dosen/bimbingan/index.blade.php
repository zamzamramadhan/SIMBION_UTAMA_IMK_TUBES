<x-dosen-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $pageTitle ?? 'Daftar Pengajuan Bimbingan' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4">Tanggal</th>
                                <th class="px-6 py-4">Mahasiswa</th>
                                <th class="px-6 py-4">Judul Proposal</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengajuans as $p)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">{{ $p->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 font-bold">{{ $p->mahasiswa->nama }}<br><span class="text-xs font-normal text-gray-500">{{ $p->mahasiswa->nim }}</span></td>
                                <td class="px-6 py-4">
                                    <div class="max-w-xs truncate">{{ $p->judul }}</div>
                                    @if($p->proposal)
                                        <a href="{{ asset('storage/'.$p->proposal) }}" target="_blank" class="text-xs text-blue-500 hover:underline">[Download Proposal]</a>
                                    @endif
                                </td>
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
                                     @if($p->status == 'pending')
                                    <div x-data="{ open: false, action: '', id: {{ $p->id }} }">
                                        <!-- Buttons -->
                                        <button @click="open = true; action = 'disetujui'" class="text-green-600 hover:text-green-900 mr-2 font-bold">Approve</button>
                                        <button @click="open = true; action = 'ditolak'" class="text-red-600 hover:text-red-900 font-bold">Reject</button>

                                        <!-- Modal (Reused) -->
                                        <div x-show="open" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" style="display: none;">
                                            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
                                                <div class="mt-3 text-center">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" x-text="action === 'disetujui' ? 'Approve Bimbingan' : 'Reject Bimbingan'"></h3>
                                                    <div class="mt-2 text-left">
                                                        <form method="POST" :action="`{{ url('/dosen/bimbingan') }}/${id}`">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" :value="action">
                                                            
                                                            <label class="block text-sm text-gray-700 dark:text-gray-300">Catatan/Alasan (Optional):</label>
                                                            <textarea name="catatan" class="w-full border rounded p-2 dark:bg-gray-700 dark:text-white"></textarea>

                                                            <div class="items-center px-4 py-3">
                                                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                                                    Confirm
                                                                </button>
                                                                <button type="button" @click="open = false" class="mt-2 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                                                    Cancel
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        <span class="text-sm text-gray-500">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada pengajuan masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-dosen-layout>
