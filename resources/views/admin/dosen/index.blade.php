<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex justify-end">
                <a href="{{ route('admin.dosen.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Tambah Dosen
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4">Nama</th>
                                <th class="px-6 py-4">NIDN</th>
                                <th class="px-6 py-4">Skills</th>
                                <th class="px-6 py-4">Kuota</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dosens as $dosen)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 font-bold">{{ $dosen->nama }}</td>
                                <td class="px-6 py-4">{{ $dosen->nidn }}</td>
                                <td class="px-6 py-4">
                                    @foreach($dosen->skills as $skill)
                                        <span class="bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded">{{ $skill->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4">{{ $dosen->kuota }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-white {{ $dosen->status == 'aktif' ? 'bg-green-500' : 'bg-red-500' }}">
                                        {{ ucfirst($dosen->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.dosen.edit', $dosen->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus dosen ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Del</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
