<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-secondary-800 leading-tight">
                {{ __('Active Orders') }}
            </h2>
            <a href="{{ route('waiter.orders.select_table') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-sm text-white tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Create New Order
            </a>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-light overflow-hidden shadow-lg sm:rounded-2xl border border-secondary-200">
                <div class="p-6 sm:p-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-secondary-200">
                            <thead class="bg-secondary-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase">Order ID</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase">Customer</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase">Table</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase">Total</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase">Time</th>
                                    <th class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-secondary-200">
                                @forelse ($orders as $order)
                                    <tr class="odd:bg-light even:bg-secondary-50">
                                        <td class="px-6 py-4 text-secondary-800">#{{ $order->id }}</td>
                                        <td class="px-6 py-4 text-secondary-800">{{ $order->customer->nama_pelanggan }}</td>
                                        <td class="px-6 py-4 text-secondary-800">{{ $order->restaurantTable->nomor_meja }}</td>
                                        <td class="px-6 py-4 text-secondary-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-secondary-800">{{ $order->created_at->format('H:i') }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('waiter.orders.show', $order->id) }}" class="inline-flex items-center px-3 py-1.5 bg-light border border-secondary-300 rounded-md font-semibold text-xs text-secondary-800 tracking-widest shadow-sm hover:bg-secondary-100 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                                Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-6 text-secondary-500">No active orders.</td>
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