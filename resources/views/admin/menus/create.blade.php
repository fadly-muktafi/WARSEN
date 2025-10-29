<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create New Menu') }}
            </h2>
            <a href="{{ route('admin.menus.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                &larr; Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Menu Details</h3>
                        <p class="mt-1 text-sm text-gray-500">Please fill in the information below to add a new menu item.</p>
                    </div>

                    <form method="POST" action="{{ route('admin.menus.store') }}">
                        @csrf
                        <div class="space-y-6">
                            {{-- Input Nama Menu --}}
                            <div>
                                <label for="nama_menu" class="block text-sm font-medium text-gray-700"> Menu Name </label>
                                <div class="mt-1">
                                    {{-- PERBAIKAN DI SINI --}}
                                    <input type="text" id="nama_menu" name="nama_menu" value="{{ old('nama_menu') }}" placeholder="e.g. Nasi Goreng Spesial"
                                           class="block w-full rounded-md shadow-sm sm:text-sm
                                           @error('nama_menu')
                                                border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500
                                           @else
                                           @enderror" />
                                </div>
                                @error('nama_menu')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Input Harga --}}
                            <div>
                                <label for="harga" class="block text-sm font-medium text-gray-700"> Price </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm"> Rp </span>
                                    </div>
                                    {{-- PERBAIKAN DI SINI JUGA --}}
                                    <input type="number" id="harga" name="harga" value="{{ old('harga') }}" min="0" step="100" placeholder="0"
                                           class="block w-full pl-12 pr-12 rounded-md sm:text-sm
                                           @error('harga')
                                                border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500
                                           @else
                                           @enderror" />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm" id="price-currency"> IDR </span>
                                    </div>
                                </div>
                                @error('harga')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-8 pt-5 border-t border-gray-200 flex items-center justify-end space-x-3">
                            <a href="{{ route('admin.menus.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-slate-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-700 focus:bg-slate-700 active:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Save Menu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>