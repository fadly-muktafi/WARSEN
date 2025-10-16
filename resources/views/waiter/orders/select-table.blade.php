<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('waiter.orders.index') }}" class="inline-flex items-center justify-center w-10 h-10 mr-4 bg-secondary-200 text-secondary-800 hover:bg-secondary-300 rounded-full transition-colors dark:bg-secondary-800 dark:text-secondary-200 dark:hover:bg-secondary-700">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-2xl text-secondary-800 leading-tight dark:text-secondary-200">
                    {{ __('Create New Order') }}
                </h2>
                <p class="mt-1 text-sm text-secondary-600 dark:text-secondary-400">
                    First, select an available table for the customer.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-secondary-200 dark:bg-secondary-800 dark:border-secondary-700">
                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-semibold text-secondary-900 mb-6 dark:text-secondary-100">Available Tables</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 sm:gap-6">
                        @forelse ($tables as $table)
                            <a href="{{ route('waiter.orders.create', ['table_id' => $table->id]) }}" 
                               class="group block p-4 border border-secondary-200 rounded-xl text-center transition-all duration-300 ease-in-out hover:border-primary-500 hover:shadow-lg hover:-translate-y-1 dark:border-secondary-700 dark:hover:border-primary-500">
                                <div class="flex items-center justify-center w-16 h-16 mx-auto bg-primary-50 rounded-full dark:bg-primary-900/20">
                                    <svg class="w-8 h-8 text-primary-600 dark:text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h4 class="mt-4 text-xl font-bold text-secondary-800 group-hover:text-primary-600 transition-colors dark:text-secondary-200 dark:group-hover:text-primary-500">
                                    {{ $table->nomor_meja }}
                                </h4>
                                <p class="mt-1 text-sm font-medium text-green-600 dark:text-green-500">
                                    Available
                                </p>
                            </a>
                        @empty
                            <div class="col-span-2 md:col-span-4 lg:col-span-6">
                                <div class="text-center bg-secondary-50 border border-secondary-200 rounded-2xl p-12 dark:bg-secondary-800 dark:border-secondary-700">
                                    <svg class="mx-auto h-12 w-12 text-secondary-400 dark:text-secondary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                    </svg>
                                    <h3 class="mt-4 text-lg font-semibold text-secondary-800 dark:text-secondary-200">No Available Tables</h3>
                                    <p class="mt-2 text-sm text-secondary-600 dark:text-secondary-400">
                                        All tables are currently occupied. Please check back later.
                                    </p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>