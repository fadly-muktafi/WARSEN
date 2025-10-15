<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Process Payment for Order #') . $transaction->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Order Details -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">Order Details</h3>
                        <p><strong>Customer:</strong> {{ $transaction->customer->nama_pelanggan ?? 'N/A' }}</p>
                        <p><strong>Table:</strong> {{ $transaction->restaurant_table_id ?? 'N/A' }}</p>
                        <p><strong>Date:</strong> {{ $transaction->created_at->format('d F Y, H:i') }}</p>
                    </div>

                    <!-- Order Items -->
                    <h3 class="text-lg font-semibold mb-4">Items</h3>
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
                            @foreach ($transaction->orderDetails as $detail)
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
                    <div class="text-right mb-6">
                        <p class="text-2xl font-bold">Total: Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                    </div>

                    <!-- Payment Form -->
                    <form action="{{ route('kasir.transactions.update', $transaction->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="amount_paid" class="block text-gray-700 text-sm font-bold mb-2">Amount Paid:</label>
                            <input type="number" name="amount_paid" id="amount_paid" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required min="{{ $transaction->total_amount }}">
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-soft-green-500 hover:bg-soft-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Submit Payment
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>