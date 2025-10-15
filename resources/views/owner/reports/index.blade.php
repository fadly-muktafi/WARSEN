<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-secondary-800 leading-tight">
                {{ __('Sales Reports') }}
            </h2>
            <a href="{{ route('owner.reports.best-selling') }}" class="inline-flex items-center px-4 py-2 bg-light border border-secondary-300 rounded-lg font-semibold text-sm text-secondary-800 tracking-widest shadow-sm hover:bg-secondary-100 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                View Best-Selling Items
            </a>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Date Filter Form -->
            <div class="bg-light overflow-hidden shadow-lg sm:rounded-2xl border border-secondary-200 no-print">
                <div class="p-6">
                    <form action="{{ route('owner.reports.index') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                            <div>
                                <x-input-label for="start_date" :value="__('Start Date')" />
                                <x-text-input id="start_date" type="date" name="start_date" value="{{ request('start_date', \Carbon\Carbon::parse($startDate)->format('Y-m-d')) }}" />
                            </div>
                            <div>
                                <x-input-label for="end_date" :value="__('End Date')" />
                                <x-text-input id="end_date" type="date" name="end_date" value="{{ request('end_date', \Carbon\Carbon::parse($endDate)->format('Y-m-d')) }}" />
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <x-primary-button class="w-full justify-center">Filter</x-primary-button>
                                <x-secondary-button type="button" onclick="window.print()" class="w-full justify-center">Print</x-secondary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-light overflow-hidden shadow-lg sm:rounded-2xl border border-secondary-200">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-secondary-700">Total Sales</h3>
                        <p class="text-3xl font-bold text-secondary-900">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="bg-light overflow-hidden shadow-lg sm:rounded-2xl border border-secondary-200">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-secondary-700">Total Transactions</h3>
                        <p class="text-3xl font-bold text-secondary-900">{{ $totalTransactions }}</p>
                    </div>
                </div>
            </div>

            <!-- Report Table -->
            <div class="bg-light overflow-hidden shadow-lg sm:rounded-2xl border border-secondary-200">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4 text-secondary-800">Transaction Details</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-secondary-200">
                            <thead class="bg-secondary-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase">Order ID</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase">Cashier</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase">Table</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase">Total</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-secondary-200">
                                @forelse ($orders as $order)
                                    <tr class="odd:bg-light even:bg-secondary-50">
                                        <td class="px-6 py-4 text-secondary-800">#{{ $order->id }}</td>
                                        <td class="px-6 py-4 text-secondary-800">{{ $order->user->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-secondary-800">{{ $order->restaurantTable->nomor_meja ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-secondary-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-secondary-800">{{ $order->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-6 text-secondary-500">No completed transactions found for this period.</td>
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