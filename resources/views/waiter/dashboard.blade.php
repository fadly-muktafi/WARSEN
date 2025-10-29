<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Waiter Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Welcome Banner --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="mt-1 text-gray-600">Here's your operational overview for today.</p>
                </div>
            </div>

            {{-- Stat Cards Grid --}}
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                
                <!-- Card 1: Orders Ready to Serve -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Orders Ready to Serve
                            </dt>
                            <dd class="text-3xl font-semibold text-gray-900">
                                {{ $ordersReadyToServe }}
                            </dd>
                        </div>
                    </div>
                </div>

                <!-- Card 2: My Active Orders -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                             <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                My Active Orders
                            </dt>
                            <dd class="text-3xl font-semibold text-gray-900">
                               {{ $myActiveOrders }}
                            </dd>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Available Tables -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-orange-500 rounded-md p-3">
                           <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Available Tables
                            </dt>
                            <dd class="text-3xl font-semibold text-gray-900">
                                {{ $availableTables }}
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Actionable Lists --}}
            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
                
                <!-- Ready to Serve List -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                         <h3 class="text-lg font-medium text-gray-900">Ready to Serve</h3>
                         <div class="mt-4 flow-root">
                            <ul role="list" class="-my-5 divide-y divide-gray-200">
                                @forelse ($readyOrdersList as $order)
                                    <li class="py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">Order #{{ $order->id }}</p>
                                                <p class="text-sm text-gray-500 truncate">For Table: {{ $order->restaurantTable->nomor_meja ?? 'N/A' }}</p>
                                            </div>
                                            <div>
                                                {{-- Tombol ini bisa diarahkan ke halaman detail pesanan --}}
                                                <a href="#" class="inline-flex items-center shadow-sm px-2.5 py-0.5 border border-gray-300 text-sm leading-5 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50">View</a>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="py-4 text-center text-gray-500 text-sm">No orders are ready to be served.</li>
                                @endforelse
                            </ul>
                         </div>
                    </div>
                </div>

                <!-- My Recent Orders List -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900">My Recent Active Orders</h3>
                        <div class="mt-4 flow-root">
                            <ul role="list" class="-my-5 divide-y divide-gray-200">
                                @forelse ($myRecentOrdersList as $order)
                                    <li class="py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">Order #{{ $order->id }}</p>
                                                <p class="text-sm text-gray-500 truncate">Table: {{ $order->restaurantTable->nomor_meja ?? 'N/A' }}</p>
                                            </div>
                                            <div>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="py-4 text-center text-gray-500 text-sm">You have no active orders.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>