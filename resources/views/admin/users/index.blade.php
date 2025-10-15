<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-secondary-800 leading-tight">
                {{ __('Users') }}
            </h2>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-lg font-semibold text-sm text-white tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                New User
            </a>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('danger'))
                <div class="bg-red-50 border-l-4 border-danger text-red-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                    <p class="font-bold">Danger</p>
                    <p>{{ session('danger') }}</p>
                </div>
            @endif

            <div class="bg-light overflow-hidden shadow-lg sm:rounded-2xl border border-secondary-200">
                <div class="p-6 sm:p-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-secondary-200">
                            <thead class="bg-secondary-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-secondary-600 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-secondary-200">
                                @foreach ($users as $user)
                                    <tr class="odd:bg-light even:bg-secondary-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-secondary-800">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-secondary-800">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-secondary-800">{{ ucfirst($user->role) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center px-3 py-1.5 bg-light border border-secondary-300 rounded-md font-semibold text-xs text-secondary-800 tracking-widest shadow-sm hover:bg-secondary-100 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                                Edit
                                            </a>
                                            <form class="inline-block" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-danger border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-red-600 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-danger focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
