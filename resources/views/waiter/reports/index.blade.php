<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-emerald-800 leading-tight dark:text-secondary-200">
            {{ __('My Sales Report') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Date Filter Form -->
            <div class="bg-white rounded-2xl shadow-md mb-8 p-6 border border-emerald-100 no-print dark:bg-secondary-800 dark:border-secondary-700">
                <form action="{{ route('waiter.reports.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2 dark:text-secondary-300">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ request('start_date', \Carbon\Carbon::parse($startDate)->format('Y-m-d')) }}" class="w-full rounded-xl border border-emerald-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 focus:outline-none transition duration-300 p-3 dark:bg-secondary-900 dark:border-secondary-600 dark:text-secondary-200 dark:focus:ring-primary-500/50 dark:focus:border-primary-500">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2 dark:text-secondary-300">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ request('end_date', \Carbon\Carbon::parse($endDate)->format('Y-m-d')) }}" class="w-full rounded-xl border border-emerald-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 focus:outline-none transition duration-300 p-3 dark:bg-secondary-900 dark:border-secondary-600 dark:text-secondary-200 dark:focus:ring-primary-500/50 dark:focus:border-primary-500">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-medium py-3 px-4 rounded-xl shadow-md transition duration-300 transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Filter
                            </button>
                            <button type="button" onclick="window.print()" class="w-full bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-medium py-3 px-4 rounded-xl shadow-md transition duration-300 transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Print
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-white/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-emerald-100">Total Revenue</h3>
                            <p class="text-3xl font-bold">Rp {{ number_format($totalSales, 0, ",", ".") }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-amber-500 to-orange-600 rounded-2xl shadow-lg p-6 text-white">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-white/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-amber-100">Total Orders</h3>
                            <p class="text-3xl font-bold">{{ $totalOrders }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-emerald-100 dark:bg-secondary-800 dark:border-secondary-700">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center dark:text-secondary-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Order Details
                    </h3>
                    <div class="overflow-x-auto rounded-xl">
                        <table class="min-w-full divide-y divide-emerald-100 dark:divide-secondary-700">
                            <thead class="bg-emerald-50 dark:bg-secondary-900/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider dark:text-secondary-400">Order ID</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider dark:text-secondary-400">Customer</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider dark:text-secondary-400">Top Item</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider dark:text-secondary-400">Total</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider dark:text-secondary-400">Time</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-emerald-100 dark:bg-secondary-800 dark:divide-secondary-700">
                                @forelse ($orders as $order)
                                    <tr class="hover:bg-emerald-50 transition duration-300 ease-in-out dark:hover:bg-secondary-900/20">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-secondary-200">#{{ $order->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-secondary-300">{{ $order->customer->nama_pelanggan ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-secondary-300">{{ $order->orderDetails->first()?->menu->nama_menu ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-emerald-600 dark:text-emerald-500">Rp {{ number_format($order->total_amount, 0, ",", ".") }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-secondary-400">{{ $order->created_at->format('H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-8">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-emerald-300 mb-4 dark:text-secondary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-gray-500 text-lg dark:text-secondary-400">No orders found for this period.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>