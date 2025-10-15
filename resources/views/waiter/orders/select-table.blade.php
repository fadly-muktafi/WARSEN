<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Select an Available Table') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @forelse ($tables as $table)
                            <div class="p-4 border rounded-lg text-center {{ $table->status === 'available' ? 'bg-white' : ($table->status === 'occupied' ? 'bg-gray-100' : 'bg-gray-50') }}">
                                <h3 class="text-lg font-bold text-gray-800">{{ $table->nomor_meja }}</h3>
                                <p class="text-sm font-medium {{ $table->status === 'available' ? 'text-green-600' : ($table->status === 'occupied' ? 'text-red-600' : 'text-yellow-600') }}">{{ ucfirst($table->status) }}</p>
                                @if($table->status === 'available')
                                    <a href="{{ route('waiter.orders.create', ['table_id' => $table->id]) }}" class="mt-4 inline-block bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                                        Create Order
                                    </a>
                                @else
                                    <span class="mt-4 inline-block bg-gray-300 text-gray-500 font-bold py-2 px-4 rounded cursor-not-allowed">
                                        Not Available
                                    </span>
                                @endif
                            </div>
                        @empty
                            <p class="col-span-4 text-center text-gray-500">No available tables found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
