<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.dosen.update', $dosen->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div>
                            <x-input-label for="nama" :value="__('Nama Lengkap')" />
                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama', $dosen->nama)" required autofocus />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <!-- Email (Readonly) -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700 cursor-not-allowed" type="email" :value="$dosen->user->email" disabled />
                            <p class="text-xs text-gray-500 mt-1">Email users cannot be changed here.</p>
                        </div>

                        <!-- NIDN -->
                        <div class="mt-4">
                            <x-input-label for="nidn" :value="__('NIDN')" />
                            <x-text-input id="nidn" class="block mt-1 w-full" type="text" name="nidn" :value="old('nidn', $dosen->nidn)" required />
                            <x-input-error :messages="$errors->get('nidn')" class="mt-2" />
                        </div>

                        <!-- Kuota -->
                        <div class="mt-4">
                            <x-input-label for="kuota" :value="__('Kuota')" />
                            <x-text-input id="kuota" class="block mt-1 w-full" type="number" name="kuota" :value="old('kuota', $dosen->kuota)" required />
                            <x-input-error :messages="$errors->get('kuota')" class="mt-2" />
                        </div>

                         <!-- Status -->
                         <div class="mt-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select name="status" id="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="aktif" {{ $dosen->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ $dosen->status == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Skills -->
                        <div class="mt-4">
                            <x-input-label for="skills" :value="__('Keahlian / Skills')" />
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-2">
                                @forelse($skills as $skill)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="skills[]" value="{{ $skill->id }}" 
                                            {{ $dosen->skills->contains('id', $skill->id) ? 'checked' : '' }}
                                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $skill->name }}</span>
                                    </label>
                                @empty
                                    <p class="text-sm text-gray-500">Belum ada data skill.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.dosen.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-300 dark:active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mr-2">
                                {{ __('Kembali') }}
                            </a>
                            <x-primary-button class="ml-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
