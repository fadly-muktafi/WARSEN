<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Order for Table ') . $table->table_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('waiter.orders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="table_id" value="{{ $table->id }}">

                        <div class="mb-4">
                            <label for="customer_name" class="block text-gray-700 text-sm font-bold mb-2">Customer Name:</label>
                            <input type="text" name="customer_name" id="customer_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label for="jumlah_pelanggan" class="block text-gray-700 text-sm font-bold mb-2">Number of Customers:</label>
                            <input type="number" name="jumlah_pelanggan" id="jumlah_pelanggan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required min="1" value="1">
                        </div>

                        <h3 class="text-lg font-semibold mb-4">Menus</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($menus as $menu)
                                <div class="border p-4 rounded-lg">
                                    <h4 class="font-bold">{{ $menu->nama_menu }}</h4>
                                    <p class="text-lg font-semibold">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                    <div class="mt-4">
                                        <label for="menu_{{ $menu->id }}" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
                                        <input type="number" name="menus[{{ $menu->id }}]" id="menu_{{ $menu->id }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="0" value="0">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
