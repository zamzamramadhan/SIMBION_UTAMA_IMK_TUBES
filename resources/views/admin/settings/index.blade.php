<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengaturan Sistem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Default Kuota -->
                        <div>
                            <x-input-label for="default_quota" :value="__('Kuota Default Dosen Baru')" />
                            <x-text-input id="default_quota" class="block mt-1 w-full" type="number" name="default_quota" :value="$settings['default_quota'] ?? 10" required />
                            <p class="text-sm text-gray-500 mt-1">Kuota yang akan diberikan secara otomatis saat menambahkan dosen baru.</p>
                            <x-input-error :messages="$errors->get('default_quota')" class="mt-2" />
                        </div>

                        <!-- Periode Pengajuan -->
                        <div class="mt-4">
                            <x-input-label for="periode_pengajuan" :value="__('Status Periode Pengajuan')" />
                            <select name="periode_pengajuan" id="periode_pengajuan" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="open" {{ ($settings['periode_pengajuan'] ?? '') == 'open' ? 'selected' : '' }}>Open (Buka)</option>
                                <option value="closed" {{ ($settings['periode_pengajuan'] ?? '') == 'closed' ? 'selected' : '' }}>Closed (Tutup)</option>
                            </select>
                            <p class="text-sm text-gray-500 mt-1">Jika ditutup, mahasiswa tidak dapat mengajukan pembimbing baru.</p>
                            <x-input-error :messages="$errors->get('periode_pengajuan')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Simpan Pengaturan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
