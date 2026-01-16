<x-dosen-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ajukan Kuota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('dosen.pengajuan.store') }}">
                        @csrf

                        <!-- Jumlah -->
                        <div>
                            <x-input-label for="jumlah" :value="__('Jumlah Penambahan Kuota')" />
                            <x-text-input id="jumlah" class="block mt-1 w-full" type="number" name="jumlah" min="1" :value="old('jumlah')" required autofocus />
                            <p class="text-sm text-gray-500 mt-1">Masukkan jumlah mahasiswa tambahan yang diinginkan.</p>
                            <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                        </div>

                        <!-- Alasan -->
                        <div class="mt-4">
                            <x-input-label for="alasan" :value="__('Alasan Pengajuan')" />
                            <textarea id="alasan" name="alasan" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('alasan') }}</textarea>
                            <x-input-error :messages="$errors->get('alasan')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('dosen.pengajuan.index') }}" class="text-gray-600 dark:text-gray-400 hover:underline mr-4">Batal</a>
                            <x-primary-button>
                                {{ __('Kirim Pengajuan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dosen-layout>
