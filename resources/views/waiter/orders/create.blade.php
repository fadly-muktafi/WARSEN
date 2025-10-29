<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{-- Menggunakan nomor_meja untuk konsistensi --}}
                {{ __('Create Order for Table ') . $table->nomor_meja }}
            </h2>
            {{-- Tombol Cancel untuk UX yang lebih baik --}}
            <a href="{{ route('waiter.orders.select_table') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Cancel
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <form action="{{ route('waiter.orders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="table_id" value="{{ $table->id }}">

                        {{-- Bagian Informasi Pelanggan --}}
                        <div class="pb-6 border-b border-gray-200">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Customer Information</h3>
                            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="customer_name" :value="__('Customer Name')" />
                                    <x-text-input id="customer_name" name="customer_name" type="text" class="mt-1 block w-full" :value="old('customer_name')" required />
                                </div>
                                <div>
                                    <x-input-label for="jumlah_pelanggan" :value="__('Number of Customers')" />
                                    <x-text-input id="jumlah_pelanggan" name="jumlah_pelanggan" type="number" class="mt-1 block w-full" value="{{ old('jumlah_pelanggan', 1) }}" required min="1" />
                                </div>
                            </div>
                        </div>

                        {{-- Bagian Pemilihan Menu --}}
                        <div class="mt-6">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Select Menus</h3>
                            <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach ($menus as $menu)
                                    {{-- Kartu Menu Individual --}}
                                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm border border-gray-200 flex flex-col justify-between">
                                        <div>
                                            <h4 class="font-semibold text-gray-800">{{ $menu->nama_menu }}</h4>
                                            <p class="text-sm text-gray-600">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                        </div>
                                        {{-- Pemilih Kuantitas Interaktif dengan Alpine.js --}}
                                        <div x-data="{ quantity: 0 }" class="mt-4">
                                            <label for="menu_{{ $menu->id }}" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                            <div class="flex items-center">
                                                <button type="button" @click="if (quantity > 0) quantity--" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-l-md hover:bg-gray-300">-</button>
                                                <input type="number" name="menus[{{ $menu->id }}]" id="menu_{{ $menu->id }}" x-model.number="quantity" class="w-16 text-center border-t border-b border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" min="0">
                                                <button type="button" @click="quantity++" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-r-md hover:bg-gray-300">+</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                            <x-primary-button>
                                {{ __('Place Order') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>