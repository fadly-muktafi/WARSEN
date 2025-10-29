<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Order Details') }}
            </h2>
            <a href="{{ route('waiter.orders.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                &larr; Back to Orders
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Kolom Kiri: Daftar Item Pesanan (Tidak ada perubahan) --}}
            <div class="lg:col-span-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    {{-- ... (Isi tabel item pesanan sama seperti sebelumnya) ... --}}
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Items Ordered</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($order->orderDetails as $detail)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $detail->menu->nama_menu }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-center">{{ $detail->jumlah }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-right">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-medium">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium text-gray-700">Total Amount</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-lg font-bold text-gray-900">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Detail & Aksi (PERUBAHAN DI SINI) --}}
            <div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Order #{{ $order->id }} Summary</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        {{-- ... (Detail Customer, Meja, Waktu sama seperti sebelumnya) ... --}}
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Customer</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $order->customer->nama_pelanggan }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Table</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">{{ $order->restaurantTable->nomor_meja }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Time</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $order->created_at->format('d F Y, H:i A') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Current Status</dt>
                                <dd class="mt-1">
                                    {{-- ... (Logika badge status sama seperti sebelumnya) ... --}}
                                    @php
                                        $statusClass = '';
                                        switch (strtolower($order->status)) {
                                            case 'pending': $statusClass = 'bg-gray-100 text-gray-800'; break;
                                            case 'cooking': $statusClass = 'bg-yellow-100 text-yellow-800'; break;
                                            case 'ready': $statusClass = 'bg-green-100 text-green-800'; break;
                                            case 'served': $statusClass = 'bg-blue-100 text-blue-800'; break;
                                            case 'paid': $statusClass = 'bg-purple-100 text-purple-800'; break;
                                            default: $statusClass = 'bg-gray-100 text-gray-800';
                                        }
                                    @endphp
                                    <span class="px-2.5 py-0.5 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusClass }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    {{-- PERUBAHAN BARU: Form Aksi Perubahan Status --}}
                    @if(!in_array(strtolower($order->status), ['served', 'paid', 'completed']))
                        <div class="p-6 bg-gray-50 border-t border-gray-200">
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Update Status</h4>
                            <form action="{{ route('waiter.orders.update_status', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="space-y-2">
                                    @if(strtolower($order->status) === 'pending')
                                        <button type="submit" name="status" value="cooking" class="w-full justify-center inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600">
                                            Mark as Cooking
                                        </button>
                                    @elseif(strtolower($order->status) === 'cooking')
                                        <button type="submit" name="status" value="ready" class="w-full justify-center inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-600">
                                            Mark as Ready
                                        </button>
                                    @elseif(strtolower($order->status) === 'ready')
                                        <button type="submit" name="status" value="served" class="w-full justify-center inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                            Mark as Served
                                        </button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>