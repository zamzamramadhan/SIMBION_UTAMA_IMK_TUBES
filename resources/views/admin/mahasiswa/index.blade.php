<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex justify-between">
                 <form method="GET" action="{{ route('admin.mahasiswa.index') }}">
                    <input type="text" name="search" placeholder="Cari Nama/NIM..." value="{{ request('search') }}" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">Cari</button>
                </form>

                <div>
                    <a href="{{ route('admin.mahasiswa.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                        + Tambah Mahasiswa
                    </a>
                    <!-- Placeholder Import Button -->
                    <a href="{{ route('admin.mahasiswa.import') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Import Excel
                    </a>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4">NIM</th>
                                <th class="px-6 py-4">Nama</th>
                                <th class="px-6 py-4">Angkatan</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mahasiswas as $mhs)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">{{ $mhs->nim }}</td>
                                <td class="px-6 py-4 font-bold">{{ $mhs->nama }}</td>
                                <td class="px-6 py-4">{{ $mhs->angkatan }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-white {{ $mhs->status == 'aktif' ? 'bg-green-500' : 'bg-gray-500' }}">
                                        {{ ucfirst($mhs->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus mahasiswa ini? Akun user juga akan terhapus.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Del</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data mahasiswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $mahasiswas->withQueryString()->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
