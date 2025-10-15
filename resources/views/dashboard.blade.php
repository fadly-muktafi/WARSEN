<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-secondary-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-light overflow-hidden shadow-lg sm:rounded-2xl border border-secondary-200">
                <div class="p-8 text-secondary-900">
                    <h3 class="text-2xl font-bold text-secondary-800">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2 text-secondary-600">{{ __("You're logged in and everything looks great.") }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
