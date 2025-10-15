<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                                <div class="mt-1">
                                    <input type="text" id="name" name="name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-300 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('name') border-red-500 @enderror" />
                                </div>
                                @error('name')
                                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                                <div class="mt-1">
                                    <input type="email" id="email" name="email" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-300 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('email') border-red-500 @enderror" />
                                </div>
                                @error('email')
                                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
                                <div class="mt-1">
                                    <input type="password" id="password" name="password" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-300 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('password') border-red-500 @enderror" />
                                </div>
                                @error('password')
                                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                <div class="mt-1">
                                    <select id="role" name="role" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-soft-green-500 focus:ring-soft-green-500 @error('role') border-red-500 @enderror">
                                        <option value="admin">Admin</option>
                                        <option value="waiter">Waiter</option>
                                        <option value="kasir">Cashier</option>
                                        <option value="owner">Owner</option>
                                    </select>
                                </div>
                                 @error('role')
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
