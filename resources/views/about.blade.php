<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-t">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>About - WARSEN</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-white">

        <!-- Header -->
        <header class="bg-white border-b border-gray-200">
            <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="{{ url('/') }}" class="-m-1.5 p-1.5 text-slate-900 font-bold tracking-tight text-lg">
                        <span>WARSEN</span>
                    </a>
                </div>
                <div class="flex flex-1 justify-end gap-x-8">
                    <a href="{{ url('/') }}" class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700">Home</a>
                    <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700">Log in <span aria-hidden="true">&rarr;</span></a>
                </div>
            </nav>
        </header>

        <main>
            <!-- Hero Section (Misi Perusahaan) -->
            <div class="bg-slate-800">
                <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">
                    <div class="mx-auto max-w-3xl text-center">
                        <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Our Mission</h1>
                        <p class="mt-6 text-lg leading-8 text-slate-300">
                            To empower restaurant owners and staff with intuitive, powerful, and elegant tools. We believe that great technology should simplify complexity, allowing you to focus on what truly matters: creating unforgettable dining experiences.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Content Section (Fitur) -->
            <div class="bg-white py-24 sm:py-32">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl lg:text-center">
                        <h2 class="text-base font-semibold leading-7 text-indigo-600">Our Philosophy</h2>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Everything you need, nothing you don't.</p>
                        <p class="mt-6 text-lg leading-8 text-gray-600">WARSEN was born from a simple idea: restaurant management should be seamless. We grew tired of clunky, complicated systems and decided to build the solution we always wanted.</p>
                    </div>
                    <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                        <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                            {{-- Feature 1 --}}
                            <div class="relative pl-16">
                                <dt class="text-base font-semibold leading-7 text-gray-900">
                                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                                    </div>
                                    Intuitive Order Management
                                </dt>
                                <dd class="mt-2 text-base leading-7 text-gray-600">A clear workflow from table-side to kitchen to cashier, ensuring no order is ever missed or delayed.</dd>
                            </div>
                            {{-- Feature 2 --}}
                            <div class="relative pl-16">
                                <dt class="text-base font-semibold leading-7 text-gray-900">
                                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.663M12 12a3 3 0 100-6 3 3 0 000 6z" /></svg>
                                    </div>
                                    Role-Based Dashboards
                                </dt>
                                <dd class="mt-2 text-base leading-7 text-gray-600">Admins, Waiters, and Cashiers each get a tailor-made dashboard, showing them only the information and tools they need to excel.</dd>
                            </div>
                            {{-- Feature 3 --}}
                            <div class="relative pl-16">
                                <dt class="text-base font-semibold leading-7 text-gray-900">
                                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h6m3-3.75l3 3m0 0l3-3m-3 3v-6" /></svg>
                                    </div>
                                    Seamless Transactions
                                </dt>
                                <dd class="mt-2 text-base leading-7 text-gray-600">From order creation to payment processing, our system ensures a smooth and error-free financial workflow.</dd>
                            </div>
                            {{-- Feature 4 --}}
                            <div class="relative pl-16">
                                <dt class="text-base font-semibold leading-7 text-gray-900">
                                    <div class="absolute left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 1.5m1-1.5l1 1.5m0 0l1 1.5m-2-1.5l-1-1.5m-6.375 5.25h14.25" /></svg>
                                    </div>
                                    Insightful Reporting
                                </dt>
                                <dd class="mt-2 text-base leading-7 text-gray-600">Make data-driven decisions with clear, concise reports on sales, transactions, and staff performance.</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </main>
        
    </body>
</html>