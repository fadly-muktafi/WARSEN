<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="m-2 p-2 bg-white rounded-lg shadow-md">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                            <div class="mt-1">
                                <input type="text" id="name" name="name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('name') border-red-500 @enderror" />
                            </div>
                            @error('name')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                            <div class="mt-1">
                                <input type="email" id="email" name="email" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('email') border-red-500 @enderror" />
                            </div>
                            @error('email')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
                            <div class="mt-1">
                                <input type="password" id="password" name="password" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5 @error('password') border-red-500 @enderror" />
                            </div>
                            @error('password')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <div class="mt-1">
                                <select id="role" name="role" class="form-multiselect block w-full mt-1 rounded-md shadow-sm @error('role') border-red-500 @enderror">
                                    <option value="admin">Admin</option>
                                    <option value="waiter">Waiter</option>
                                    <option value="kasir">Cashier</option>
                                    <option value="owner">Owner</option>
                                </select>
                            </div>
                             @error('role')
                                <div class="text-sm text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-6 p-4">
                            <button type="submit" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Store</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
