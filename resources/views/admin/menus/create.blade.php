<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.menus.store') }}">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="nama_menu" class="block text-sm font-medium text-gray-700"> Name </label>
                                <div class="mt-1">
                                    <input type="text" id="nama_menu" name="nama_menu" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-300 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('nama_menu') border-red-500 @enderror" />
                                </div>
                                @error('nama_menu')
                                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="harga" class="block text-sm font-medium text-gray-700"> Price </label>
                                <div class="mt-1">
                                    <input type="number" id="harga" name="harga" min="0.00" step="1000" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-300 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('harga') border-red-500 @enderror" />
                                </div>
                                @error('harga')
                                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-soft-green-600 hover:bg-soft-green-700 rounded-lg text-white font-semibold text-xs tracking-widest">Store</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
