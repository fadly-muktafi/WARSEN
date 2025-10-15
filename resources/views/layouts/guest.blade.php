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
    <body class="font-sans text-secondary-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-secondary-100">
            <div class="mb-6">
                <a href="/">
                    <x-application-logo class="w-24 h-24 fill-current text-secondary-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md p-8 bg-light shadow-lg overflow-hidden sm:rounded-2xl border border-secondary-200">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
