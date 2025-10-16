<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-f">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-emerald-900 antialiased bg-gradient-to-br from-emerald-50 to-cyan-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-6">
                <a href="/" class="flex justify-center">
                    <x-application-logo class="w-24 h-24 fill-current text-emerald-600" />
                </a>
                <div class="text-center mt-2">
                    <h1 class="text-2xl font-bold text-emerald-800">LaundryPro</h1>
                    <p class="text-emerald-600">Professional Laundry Service</p>
                </div>
            </div>

            <div class="w-full sm:max-w-md p-8 bg-white/90 backdrop-blur-sm shadow-xl overflow-hidden sm:rounded-2xl border border-emerald-100 transition-all duration-300">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
