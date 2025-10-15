<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Table') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.tables.update', $table->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <div>
                                <label for="nomor_meja" class="block text-sm font-medium text-gray-700"> Table Number </label>
                                <div class="mt-1">
                                    <input type="text" id="nomor_meja" name="nomor_meja" value="{{ $table->nomor_meja }}" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-300 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('nomor_meja') border-red-500 @enderror" />
                                </div>
                                @error('nomor_meja')
                                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <div class="mt-1">
                                    <select id="status" name="status" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-soft-green-500 focus:ring-soft-green-500 @error('status') border-red-500 @enderror">
                                        @foreach (['available', 'occupied'] as $status)
                                            <option value="{{ $status }}" @if ($table->status == $status) selected @endif>{{ ucfirst($status) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('status')
                                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-soft-green-600 hover:bg-soft-green-700 rounded-lg text-white font-semibold text-xs tracking-widest">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
