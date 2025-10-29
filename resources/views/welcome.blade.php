<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WARSEN - Welcome</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        {{-- Menggunakan font Inter yang sama dengan aplikasi internal --}}
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        {{-- Latar belakang utama dan overlay gelap --}}
        <div class="relative min-h-screen bg-gray-900">
            {{-- Gambar Latar Belakang --}}
            {{-- Ganti URL ini dengan gambar restoran Anda. Sumber: unsplash.com --}}
            <div class="absolute inset-0">
                <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=1974&auto=format&fit=crop" alt="Suasana Restoran Warsen">
                <div class="absolute inset-0 bg-gray-900/75 mix-blend-multiply" aria-hidden="true"></div>
            </div>

            {{-- Konten Utama --}}
            <div class="relative min-h-screen flex flex-col items-center justify-center p-6 text-center text-white">
                
                <!-- Header dengan Tombol Login/Register -->
                <header class="absolute top-0 right-0 p-6">
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="rounded-md px-4 py-2 text-white ring-1 ring-transparent transition hover:text-white/70 focus:outline-none focus-visible:ring-white"
                                >
                                    Dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="rounded-md px-4 py-2 text-white ring-1 ring-transparent transition hover:text-white/70 focus:outline-none focus-visible:ring-white"
                                >
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="rounded-md px-4 py-2 text-white ring-1 ring-transparent transition hover:text-white/70 focus:outline-none focus-visible:ring-white"
                                    >
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>

                <!-- Konten Hero Section -->
                <main class="max-w-3xl">
                    {{-- Logo WARSEN --}}
                    <div>
                        {{-- Anda bisa mengganti ini dengan file SVG logo WARSEN jika ada --}}
                        <h1 class="text-6xl md:text-8xl font-black tracking-tighter text-white drop-shadow-lg">
                            WARSEN
                        </h1>
                    </div>

                    <p class="mt-4 text-lg md:text-xl text-gray-200 max-w-xl mx-auto drop-shadow-md">
                        The ultimate management system for your restaurant. Streamline orders, manage tables, and empower your staff.
                    </p>

                    <div class="mt-8 flex justify-center gap-x-4">
                        <a href="{{ route('login') }}" class="inline-block rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-transform hover:scale-105">
                            Staff Login
                        </a>
                        <a href="{{ route('about') }}" class="inline-block rounded-lg px-6 py-3 text-sm font-semibold leading-6 text-white ring-1 ring-white/20 hover:ring-white/30 transition-transform hover:scale-105">
                            Learn More <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </main>

                <!-- Footer Sederhana -->
                <footer class="absolute bottom-0 p-6 text-xs text-gray-400">
                    &copy; {{ date('Y') }} WARSEN Restaurant Management. All rights reserved.
                </footer>
            </div>
        </div>
    </body>
</html>