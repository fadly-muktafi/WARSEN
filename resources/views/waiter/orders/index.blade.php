<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <div>
                <h2 class="font-semibold text-2xl text-secondary-800 leading-tight dark:text-secondary-200">
                    {{ __('Active Orders') }}
                </h2>
                <p class="mt-1 text-sm text-secondary-600 dark:text-secondary-400">
                    Manage all ongoing customer orders here.
                </p>
            </div>
            <a href="{{ route('waiter.orders.select_table') }}" class="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-sm text-white shadow-md hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:focus:ring-offset-secondary-900">
                <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>New Order</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 text-green-800 p-4 rounded-lg shadow-sm dark:bg-green-900/20 dark:border-green-500 dark:text-green-300" role="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg class="h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Success</p>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($orders as $order)
                    <div class="bg-white border border-secondary-200 rounded-2xl shadow-sm hover:shadow-lg transition-shadow duration-300 ease-in-out dark:bg-secondary-800 dark:border-secondary-700">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400">Table</p>
                                    <p class="text-2xl font-bold text-primary-600 dark:text-primary-500">{{ $order->restaurantTable->nomor_meja }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400">Order ID</p>
                                    <p class="text-sm font-mono text-secondary-800 dark:text-secondary-300">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                            <div class="mt-4 border-t border-secondary-100 pt-4 dark:border-secondary-700">
                                <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400">Customer</p>
                                <p class="text-lg font-semibold text-secondary-800 dark:text-secondary-200">{{ $order->customer->nama_pelanggan }}</p>
                            </div>
                            <div class="mt-4">
                                <p class="text-sm font-medium text-secondary-500 dark:text-secondary-400">Total</p>
                                <p class="text-xl font-bold text-secondary-900 dark:text-secondary-100">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </div>
                            <div class="mt-6 flex justify-between items-center">
                                <div class="flex items-center text-sm text-secondary-500 dark:text-secondary-400">
                                    <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $order->created_at->format('H:i A') }}</span>
                                </div>
                                <a href="{{ route('waiter.orders.show', $order->id) }}" class="inline-flex items-center px-4 py-2 bg-secondary-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary-500 transition ease-in-out duration-150 dark:bg-secondary-600 dark:hover:bg-secondary-500 dark:focus:ring-offset-secondary-800">
                                    Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <div class="text-center bg-white border border-secondary-200 rounded-2xl p-12 dark:bg-secondary-800 dark:border-secondary-700">
                            <svg class="mx-auto h-12 w-12 text-secondary-400 dark:text-secondary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-semibold text-secondary-800 dark:text-secondary-200">No Active Orders</h3>
                            <p class="mt-2 text-sm text-secondary-600 dark:text-secondary-400">
                                When a new order is created, it will appear here.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('waiter.orders.select_table') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-sm text-white shadow-md hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150 dark:focus:ring-offset-secondary-800">
                                    <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <span>Create First Order</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
