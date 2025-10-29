<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cashier Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Welcome Banner --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="mt-1 text-gray-600">Here's a summary of today's transactions.</p>
                </div>
            </div>

            {{-- Stat Cards Grid --}}
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                
                <!-- Card 1: Pending Payments -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Pending Payments
                            </dt>
                            <dd class="text-3xl font-semibold text-gray-900">
                                {{ $pendingPaymentsCount }}
                            </dd>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Today's Revenue -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                             <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1m0 1H9m3 0h3m-3 12v-1m0 1c-1.11 0-2.08-.402-2.599-1M12 18v-1m0 1h3m-3 0H9" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Today's Revenue
                            </dt>
                            <dd class="text-2xl font-semibold text-gray-900">
                               Rp {{ number_format($todayRevenue, 0, ',', '.') }}
                            </dd>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Today's Transactions -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                           <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Today's Transactions
                            </dt>
                            <dd class="text-3xl font-semibold text-gray-900">
                                {{ $todayTransactionsCount }}
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Actionable Lists --}}
            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                
                <!-- Pending Payments List -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                         <h3 class="text-lg font-medium text-gray-900">Awaiting Payment</h3>
                         <div class="mt-4 flow-root">
                            <ul role="list" class="-my-5 divide-y divide-gray-200">
                                @forelse ($pendingPaymentsList as $order)
                                    <li class="py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">Order #{{ $order->id }} (Table: {{ $order->restaurantTable->nomor_meja }})</p>
                                                <p class="text-sm text-gray-500 truncate">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                            </div>
                                            <div>
                                                {{-- Tombol ini harus mengarah ke halaman pembuatan transaksi --}}
                                                <a href="{{ route('kasir.transactions.create', ['order_id' => $order->id]) }}" class="inline-flex items-center shadow-sm px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-full text-white bg-green-600 hover:bg-green-700">Process</a>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="py-4 text-center text-gray-500 text-sm">No orders are awaiting payment.</li>
                                @endforelse
                            </ul>
                         </div>
                    </div>
                </div>

                <!-- Today's Completed Transactions List -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900">Today's Completed Transactions</h3>
                        <div class="mt-4 flow-root">
                            <ul role="list" class="-my-5 divide-y divide-gray-200">
                                @forelse ($completedTransactionsList as $order)
                                    <li class="py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">Order #{{ $order->id }} (Table: {{ $order->restaurantTable->nomor_meja }})</p>
                                                <p class="text-sm text-gray-500 truncate">{{ $order->updated_at->format('H:i A') }}</p>
                                            </div>
                                            <div>
                                                <a href="{{ route('kasir.transactions.receipt', $order->id) }}" class="inline-flex items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50">Receipt</a>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="py-4 text-center text-gray-500 text-sm">No transactions have been completed today.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>