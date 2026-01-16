<x-mahasiswa-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Form Pengajuan Pembimbing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('mahasiswa.pengajuan.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Dosen Selection -->
                         <div>
                            <x-input-label for="dosen_id" :value="__('Pilih Dosen Pembimbing')" />
                            <select id="dosen_id" name="dosen_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Dosen --</option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}">
                                        {{ $dosen->nama }} (Sisa Kuota: {{ $dosen->sisa ?? 'N/A' }}) - Skills: {{ $dosen->skills->pluck('name')->join(', ') }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('dosen_id')" class="mt-2" />
                        </div>

                        <!-- Judul -->
                        <div class="mt-4">
                            <x-input-label for="judul" :value="__('Judul Proposal')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" required />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <!-- Proposal File -->
                        <div class="mt-4">
                            <x-input-label for="proposal" :value="__('Upload Proposal (PDF/DOCX, Max 2MB)')" />
                            <input id="proposal" class="block mt-1 w-full border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="proposal" required accept=".pdf,.doc,.docx">
                            <x-input-error :messages="$errors->get('proposal')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('mahasiswa.pengajuan.index') }}" class="text-gray-600 dark:text-gray-400 hover:underline mr-4">Batal</a>
                             <x-primary-button>
                                {{ __('Kirim Pengajuan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-mahasiswa-layout>
