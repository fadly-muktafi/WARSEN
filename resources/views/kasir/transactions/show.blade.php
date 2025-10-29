<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Process Payment for Order #') . $transaction->id }}
            </h2>
            <a href="{{ route('kasir.transactions.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                &larr; Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Kolom Kiri: Rincian Tagihan --}}
            <div class="lg:col-span-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Order Summary</h3>
                        <div class="mt-4 flex justify-between text-sm">
                            <div class="text-gray-600">
                                <p><span class="font-medium">Customer:</span> {{ $transaction->customer->nama_pelanggan ?? 'N/A' }}</p>
                                <p><span class="font-medium">Table:</span> {{ $transaction->restaurantTable->nomor_meja ?? 'N/A' }}</p>
                            </div>
                            <div class="text-gray-600 text-right">
                                <p><span class="font-medium">Order Time:</span></p>
                                <p>{{ $transaction->created_at->format('d M Y, H:i A') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Tabel Item Pesanan --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($transaction->orderDetails as $detail)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $detail->menu->nama_menu }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-center">{{ $detail->jumlah }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-right">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-medium">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Area Pembayaran Interaktif --}}
            <div class="lg:col-span-1">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900">Payment</h3>
                        
                        {{-- Kalkulator Pembayaran dengan Alpine.js --}}
                        <div x-data="{ 
                                totalAmount: {{ $transaction->total_amount }}, 
                                amountPaid: null,
                                get change() { 
                                    const paid = parseFloat(this.amountPaid);
                                    if (isNaN(paid) || paid < this.totalAmount) {
                                        return 0;
                                    }
                                    return paid - this.totalAmount;
                                } 
                            }">
                            
                            {{-- Total Tagihan --}}
                            <div class="my-6 text-center">
                                <p class="text-sm text-gray-500">Total Due</p>
                                <p class="text-4xl font-bold tracking-tight text-gray-900">
                                    Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                </p>
                            </div>

                            <form action="{{ route('kasir.transactions.update', $transaction->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="space-y-4">
                                    {{-- Input Jumlah Dibayar --}}
                                    <div>
                                        <x-input-label for="amount_paid" :value="__('Amount Paid')" />
                                        <x-text-input type="number" name="amount_paid" id="amount_paid" class="mt-1 block w-full text-lg" 
                                                      x-model.number="amountPaid"
                                                      placeholder="Enter amount paid"
                                                      required 
                                                      min="0"
                                                      step="1000" />
                                    </div>

                                    {{-- Tampilan Kembalian --}}
                                    <div x-show="amountPaid && amountPaid >= totalAmount" class="p-4 bg-blue-50 rounded-lg text-center">
                                        <p class="text-sm text-blue-700">Change</p>
                                        <p class="text-2xl font-bold text-blue-900">
                                            Rp <span x-text="change.toLocaleString('id-ID')"></span>
                                        </p>
                                    </div>
                                    
                                    {{-- Tombol Submit --}}
                                    <div class="pt-2">
                                        <button type="submit" 
                                                :disabled="!amountPaid || amountPaid < totalAmount"
                                                class="w-full justify-center inline-flex items-center px-4 py-3 bg-green-600 border border-transparent rounded-lg font-semibold text-sm text-white tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150
                                                       disabled:opacity-50 disabled:cursor-not-allowed">
                                            Submit Payment
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>