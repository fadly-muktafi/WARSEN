<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Details for Order #') . $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('waiter.orders.index') }}" class="text-soft-green-500 hover:text-soft-green-700">&larr; Back to Active Orders</a>
                    </div>

                    <!-- Order Details -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">Order Details</h3>
                        <p><strong>Customer:</strong> {{ $order->customer->nama_pelanggan }}</p>
                        <p><strong>Table:</strong> {{ $order->restaurantTable->nomor_meja }}</p>
                        <p><strong>Date:</strong> {{ $order->created_at->format('d F Y, H:i') }}</p>
                    </div>

                    <!-- Order Items -->
                    <h3 class="text-lg font-semibold mb-4">Items Ordered</h3>
                    <table class="min-w-full divide-y divide-gray-200 mb-6">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Menu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($order->orderDetails as $detail)
                                <tr>
                                    <td class="px-6 py-4">{{ $detail->menu->nama_menu }}</td>
                                    <td class="px-6 py-4">{{ $detail->jumlah }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Total Amount -->
                    <div class="text-right">
                        <p class="text-2xl font-bold">Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
