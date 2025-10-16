<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-secondary-200">
            {{ __('Cashier Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl border border-secondary-200 dark:bg-secondary-800 dark:border-secondary-700">
                <div class="p-8 text-gray-900 dark:text-secondary-200">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-secondary-200">Welcome, Cashier!</h3>
                    <p class="mt-2 text-gray-600 dark:text-secondary-400">{{ __("You're logged in as a Cashier.") }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
