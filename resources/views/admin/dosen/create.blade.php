<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.dosen.store') }}">
                        @csrf

                        <!-- Nama -->
                        <div>
                            <x-input-label for="nama" :value="__('Nama Lengkap')" />
                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- NIDN -->
                        <div class="mt-4">
                            <x-input-label for="nidn" :value="__('NIDN')" />
                            <x-text-input id="nidn" class="block mt-1 w-full" type="text" name="nidn" :value="old('nidn')" required />
                            <x-input-error :messages="$errors->get('nidn')" class="mt-2" />
                        </div>

                        <!-- Skills -->
                        <div class="mt-4">
                            <x-input-label for="skills" :value="__('Keahlian / Skills')" />
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-2">
                                @forelse($skills as $skill)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="skills[]" value="{{ $skill->id }}" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $skill->name }}</span>
                                    </label>
                                @empty
                                    <p class="text-sm text-gray-500">Belum ada data skill.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
