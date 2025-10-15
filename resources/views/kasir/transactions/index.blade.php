<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-secondary-800 leading-tight">
            {{ __('Pending Orders') }}
        </h2>
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
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase tracking-wider">Order ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase tracking-wider">Customer Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase tracking-wider">Table Number</th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase tracking-wider">Total Amount</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-secondary-200">
                                @forelse ($orders as $order)
                                    <tr class="odd:bg-light even:bg-secondary-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-secondary-800">{{ $order->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-secondary-800">{{ $order->customer->nama_pelanggan ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-secondary-800">{{ $order->restaurant_table_id ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-secondary-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('kasir.transactions.show', $order->id) }}" class="inline-flex items-center px-3 py-1.5 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Process Payment
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-secondary-500">
                                            No pending orders found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
