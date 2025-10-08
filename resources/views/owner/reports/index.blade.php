<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sales Reports') }}
            </h2>
            <a href="{{ route('owner.reports.best-selling') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                View Best-Selling Items &rarr;
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Date Filter Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 no-print">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('owner.reports.index') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date', \Carbon\Carbon::parse($startDate)->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date', \Carbon\Carbon::parse($endDate)->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            <div class="self-end">
                                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Filter Report
                                </button>
                                <button type="button" onclick="window.print()" class="w-full mt-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Print to PDF
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold">Total Sales</h3>
                        <p class="text-3xl font-bold">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold">Total Transactions</h3>
                        <p class="text-3xl font-bold">{{ $totalTransactions }}</p>
                    </div>
                </div>
            </div>

            <!-- Report Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Transaction Details</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cashier</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Table</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($orders as $order)
                                <tr>
                                    <td class="px-6 py-4">#{{ $order->id }}</td>
                                    <td class="px-6 py-4">{{ $order->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">{{ $order->restaurantTable->table_number ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">{{ $order->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">No completed transactions found for this period.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>