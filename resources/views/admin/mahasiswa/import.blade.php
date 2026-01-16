<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Import Data Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="mb-4 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Format Excel/CSV:</strong>
                        <span class="block sm:inline">Pastikan file memiliki header kolom: <b>NIM, Nama, Email, Angkatan</b>. Password default akan diset sama dengan NIM.</span>
                    </div>

                    <form method="POST" action="{{ route('admin.mahasiswa.import.process') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- File Input -->
                        <div>
                            <x-input-label for="file" :value="__('Upload File (.xlsx, .csv)')" />
                            <input id="file" class="block mt-1 w-full border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="file" required accept=".csv, .xlsx, .xls">
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Upload & Import') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
