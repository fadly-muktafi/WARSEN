<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Select an Available Table') }}
            </h2>
            <a href="{{ route('waiter.orders.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                &larr; Back to Orders
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">
                    {{-- Kisi-kisi Meja --}}
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                        @forelse ($tables as $table)
                            {{-- Membungkus kartu dalam tautan jika tersedia untuk area klik yang lebih besar --}}
                            @if($table->status === 'available')
                                <a href="{{ route('waiter.orders.create', ['table_id' => $table->id]) }}" 
                                   class="group block p-6 bg-white border border-gray-200 rounded-lg shadow-sm
                                          hover:border-indigo-500 hover:shadow-lg transition-all duration-200 ease-in-out
                                          transform hover:-translate-y-1">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-xl font-bold text-gray-800">{{ $table->nomor_meja }}</h3>
                                        {{-- Ikon Meja --}}
                                        <svg class="w-8 h-8 text-green-400 group-hover:text-indigo-500 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 13.5v-6m0 6h-6m6 0v6m0-6h6m-6-6v-3a3 3 0 00-3-3H9a3 3 0 00-3 3v3m12 0v3a3 3 0 01-3 3H9a3 3 0 01-3-3v-3m0 0h12" /></svg>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Available
                                        </span>
                                    </div>
                                </a>
                            @else
                                {{-- Kartu untuk meja yang tidak tersedia (tidak dapat diklik) --}}
                                <div class="block p-6 bg-gray-50 border border-gray-200 rounded-lg shadow-sm opacity-70">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-xl font-bold text-gray-500">{{ $table->nomor_meja }}</h3>
                                         {{-- Ikon Meja Terisi --}}
                                        <svg class="w-8 h-8 text-red-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 13.5v-6m0 6h-6m6 0v6m0-6h6m-6-6v-3a3 3 0 00-3-3H9a3 3 0 00-3 3v3m12 0v3a3 3 0 01-3 3H9a3 3 0 01-3-3v-3m0 0h12" /></svg>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Occupied
                                        </span>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="col-span-full py-12 text-center">
                                <h3 class="text-lg font-medium text-gray-900">No Tables Found</h3>
                                <p class="mt-1 text-sm text-gray-500">There are no tables configured in the system.</p>
                                {{-- Tombol untuk admin, jika login sebagai admin --}}
                                @if(strtolower(Auth::user()->role) === 'admin')
                                    <div class="mt-6">
                                        <a href="{{ route('admin.tables.create') }}" class="inline-flex items-center px-4 py-2 bg-slate-800 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-slate-700">
                                            Add New Table
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>