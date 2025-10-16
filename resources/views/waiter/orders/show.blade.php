<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('waiter.orders.index') }}" class="inline-flex items-center justify-center w-10 h-10 mr-4 bg-secondary-200 text-secondary-800 hover:bg-secondary-300 rounded-full transition-colors dark:bg-secondary-800 dark:text-secondary-200 dark:hover:bg-secondary-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-2xl text-secondary-800 leading-tight dark:text-secondary-200">
                    Order <span class="font-mono text-primary-600 dark:text-primary-500">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                </h2>
                <p class="mt-1 text-sm text-secondary-600 dark:text-secondary-400">
                    Details for the order placed at {{ $order->created_at->format('H:i A') }}.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-3 lg:gap-8">

                <!-- Left Column: Order Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white border border-secondary-200 shadow-sm sm:rounded-2xl dark:bg-secondary-800 dark:border-secondary-700">
                        <div class="p-6 sm:p-8">
                            <h3 class="text-xl font-semibold text-secondary-900 mb-6 dark:text-secondary-100">Items Ordered</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-secondary-200 dark:divide-secondary-700">
                                    <thead class="bg-secondary-50 dark:bg-secondary-900/50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-secondary-600 uppercase tracking-wider dark:text-secondary-400">Menu</th>
                                            <th class="px-6 py-3 text-center text-xs font-semibold text-secondary-600 uppercase tracking-wider dark:text-secondary-400">Quantity</th>
                                            <th class="px-6 py-3 text-right text-xs font-semibold text-secondary-600 uppercase tracking-wider dark:text-secondary-400">Price</th>
                                            <th class="px-6 py-3 text-right text-xs font-semibold text-secondary-600 uppercase tracking-wider dark:text-secondary-400">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-secondary-200 dark:bg-secondary-800 dark:divide-secondary-700">
                                        @foreach ($order->orderDetails as $detail)
                                            <tr class="hover:bg-secondary-50 dark:hover:bg-secondary-900/20">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-secondary-900 dark:text-secondary-200">{{ $detail->menu->nama_menu }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-600 text-center dark:text-secondary-400">{{ $detail->jumlah }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-600 text-right dark:text-secondary-400">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-secondary-800 text-right dark:text-secondary-300">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Order Summary -->
                <div class="lg:col-span-1 mt-8 lg:mt-0">
                    <div class="sticky top-24">
                        <div class="bg-white p-6 sm:p-8 border border-secondary-200 shadow-sm sm:rounded-2xl dark:bg-secondary-800 dark:border-secondary-700">
                            <h3 class="text-xl font-semibold text-secondary-900 dark:text-secondary-100">Summary</h3>
                            
                            <div class="mt-6 space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Customer</span>
                                    <span class="text-sm font-semibold text-secondary-900 dark:text-secondary-200">{{ $order->customer->nama_pelanggan }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Table</span>
                                    <span class="text-sm font-semibold text-secondary-900 dark:text-secondary-200">{{ $order->restaurantTable->nomor_meja }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Date</span>
                                    <span class="text-sm font-semibold text-secondary-900 dark:text-secondary-200">{{ $order->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-secondary-600 dark:text-secondary-400">Time</span>
                                    <span class="text-sm font-semibold text-secondary-900 dark:text-secondary-200">{{ $order->created_at->format('H:i A') }}</span>
                                </div>
                            </div>

                            <div class="mt-6 border-t border-primary-200 pt-4 dark:border-primary-500/30">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-secondary-800 dark:text-secondary-200">Total</span>
                                    <span class="text-2xl font-bold text-primary-600 dark:text-primary-500">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>