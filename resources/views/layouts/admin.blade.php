<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col">
                <!-- Top Header -->
                <header style="background-color: #373B85;" class="text-white h-16 flex items-center justify-between px-6 shadow-sm">
                    <div class="text-xl font-bold">
                        Simbion@Utama
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm">Administrator</span>
                        <div class="relative x-data='{ open: false }'">
                            <button class="flex items-center gap-2 focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-white text-indigo-900 flex items-center justify-center font-bold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </button>
                             <!-- Simple Logout Link for now, can be dropdown later -->
                             <form method="POST" action="{{ route('logout') }}" class="inline ml-2">
                                @csrf
                                <button type="submit" class="text-xs text-indigo-200 hover:text-white underline">Logout</button>
                            </form>
                        </div>
                    </div>
                </header>

                <!-- Content -->
                <main class="flex-1 p-6 overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
