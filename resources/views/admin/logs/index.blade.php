<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Log Aktivitas Sistem') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-4">Waktu</th>
                                <th class="px-6 py-4">User</th>
                                <th class="px-6 py-4">Aktivitas</th>
                                <th class="px-6 py-4">Jenis</th>
                                <th class="px-6 py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">{{ $log->created_at->format('d M Y H:i:s') }}</td>
                                <td class="px-6 py-4 font-bold">{{ $log->user->name ?? 'System/Guest' }}</td>
                                <td class="px-6 py-4">{{ $log->detail ?? $log->aktivitas }}</td>
                                <td class="px-6 py-4 uppercase text-xs">{{ $log->jenis ?? 'GENERAL' }}</td>
                                <td class="px-6 py-4">
                                     @if($log->status == 'success')
                                        <span class="text-green-500">Success</span>
                                    @elseif($log->status == 'failed')
                                        <span class="text-red-500">Failed</span>
                                    @else
                                        <span class="text-gray-500">Info</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada log aktivitas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
