<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-emerald-800 leading-tight">
                    {{ __('Laundry Staff') }}
                </h2>
                <p class="text-emerald-600 mt-1">Manage your laundry business team</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 border border-transparent rounded-xl font-semibold text-white tracking-widest focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Staff
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-400 text-emerald-700 p-4 mb-6 rounded-xl shadow-md" role="alert">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="font-bold">Success</p>
                    </div>
                    <p class="mt-1">{{ session('success') }}</p>
                </div>
            @endif
            @if (session('danger'))
                <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 mb-6 rounded-xl shadow-md" role="alert">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="font-bold">Error</p>
                    </div>
                    <p class="mt-1">{{ session('danger') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-emerald-100">
                <div class="p-6 sm:p-8">
                    <div class="overflow-x-auto rounded-xl">
                        <table class="min-w-full divide-y divide-emerald-100">
                            <thead class="bg-emerald-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-sm font-bold text-emerald-700 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-4 text-left text-sm font-bold text-emerald-700 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-4 text-left text-sm font-bold text-emerald-700 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="relative px-6 py-4">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-emerald-100">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-emerald-50 transition duration-300 ease-in-out">
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center">
                                                    <span class="text-emerald-600 font-medium">{{ substr($user->name, 0, 1) }}</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 bg-emerald-100 hover:bg-emerald-200 border border-emerald-300 rounded-lg font-semibold text-emerald-700 tracking-widest focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-300 shadow-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <form class="inline-block" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this staff member?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-100 hover:bg-red-200 border border-red-300 rounded-lg font-semibold text-red-700 tracking-widest focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-300 shadow-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 flex justify-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>