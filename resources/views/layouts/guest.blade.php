<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
        </style>
    </head>
    <body class="font-sans text-slate-600 antialiased bg-slate-50 relative overflow-hidden">
        
        <!-- Background Decoration -->
        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-200/20 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-200/20 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            <div>
                <a href="/" class="flex flex-col items-center gap-2 group">
                    <div class="relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-200"></div>
                        <img src="{{ asset('images/logo-simbion.png') }}" alt="SIMBION" class="relative block h-16 w-auto bg-white rounded-lg p-1.5 shadow-sm">
                    </div>
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-700 tracking-tight">SIMBION UTAMA</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-8 py-10 bg-white shadow-2xl shadow-slate-200/50 overflow-hidden sm:rounded-[2rem] border border-slate-100">
                {{ $slot }}
            </div>

            <div class="mt-8 text-center text-sm text-slate-400">
                &copy; {{ date('Y') }} SIMBION. All rights reserved.
            </div>
        </div>
    </body>
</html>
