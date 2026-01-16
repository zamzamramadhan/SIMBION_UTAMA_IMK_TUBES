<x-mahasiswa-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengajuan Bimbingan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if($pengajuan)
                        <div class="text-center">
                            <h3 class="text-lg font-bold mb-4">Status Pengajuan Anda</h3>
                            
                             <div class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white 
                                {{ $pengajuan->status == 'pending' ? 'bg-yellow-500' : ($pengajuan->status == 'disetujui' ? 'bg-green-500' : 'bg-red-500') }}">
                                {{ ucfirst($pengajuan->status) }}
                            </div>

                            <div class="mt-6 text-left max-w-lg mx-auto border p-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                                <p><strong>Dosen Pembimbing:</strong> {{ $pengajuan->dosen->nama }}</p>
                                <p><strong>Judul Proposal:</strong> {{ $pengajuan->judul }}</p>
                                <p><strong>Tanggal Pengajuan:</strong> {{ $pengajuan->created_at->format('d M Y') }}</p>
                                @if($pengajuan->proposal)
                                    <p class="mt-2"><a href="{{ asset('storage/'.$pengajuan->proposal) }}" target="_blank" class="text-blue-500 hover:underline">Lihat Proposal</a></p>
                                @endif
                                @if($pengajuan->catatan)
                                    <p class="mt-2 text-red-500"><strong>Catatan Dosen:</strong> {{ $pengajuan->catatan }}</p>
                                @endif
                            </div>

                            @if($pengajuan->status == 'ditolak')
                                <div class="mt-6">
                                    <a href="{{ route('mahasiswa.pengajuan.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Ajukan Ulang
                                    </a>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-10">
                            <p class="mb-4 text-gray-600 dark:text-gray-400">Anda belum mengajukan dosen pembimbing.</p>
                            <a href="{{ route('mahasiswa.pengajuan.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                + Buat Pengajuan Baru
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-mahasiswa-layout>
