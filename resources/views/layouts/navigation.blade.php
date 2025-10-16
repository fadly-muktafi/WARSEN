<!-- resources/views/layouts/navigation.blade.php -->
<div class="w-64 h-screen bg-white/90 backdrop-blur-sm text-emerald-900 flex flex-col no-print sticky top-0 shadow-lg border-r border-emerald-100 z-10 dark:bg-secondary-900/90 dark:border-secondary-800 dark:text-secondary-200">
    <!-- Logo -->
    <div class="flex items-center justify-center h-20 border-b border-emerald-100 bg-gradient-to-r from-emerald-50 to-teal-50 dark:border-secondary-800 dark:bg-gradient-to-r dark:from-secondary-800 dark:to-secondary-900">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
            <x-application-logo class="block h-10 w-auto fill-current text-emerald-600 dark:text-primary-500" />
            <span class="text-xl font-bold text-emerald-800 hidden md:block dark:text-secondary-100">Restaurant</span>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 py-6 space-y-1">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-secondary-800 dark:hover:text-secondary-100">
            <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" /></svg>
            {{ __('Dashboard') }}
        </x-nav-link>

        @if (Auth::user()->role == 'admin')
            <x-nav-link :href="route('admin.menus.index')" :active="request()->routeIs('admin.menus.index')" class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-secondary-800 dark:hover:text-secondary-100">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                {{ __('Menus') }}
            </x-nav-link>
            <x-nav-link :href="route('admin.tables.index')" :active="request()->routeIs('admin.tables.index')" class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-secondary-800 dark:hover:text-secondary-100">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                {{ __('Tables') }}
            </x-nav-link>
            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')" class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-secondary-800 dark:hover:text-secondary-100">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.663M12 12a3 3 0 100-6 3 3 0 000 6z" /></svg>
                {{ __('Users') }}
            </x-nav-link>
        @elseif (Auth::user()->role == 'waiter')
            <x-nav-link :href="route('waiter.orders.index')" :active="request()->routeIs('waiter.orders.index')" class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-secondary-800 dark:hover:text-secondary-100">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c.51 0 .962-.343 1.087-.835l1.823-6.841a1.125 1.125 0 00-.84-1.332H8.324a1.125 1.125 0 00-.84 1.332l1.823 6.841zM12 18a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm-4.5-4.5V5.625" /></svg>
                {{ __('Orders') }}
            </x-nav-link>
            <x-nav-link :href="route('waiter.reports.index')" :active="request()->routeIs('waiter.reports.index')" class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-secondary-800 dark:hover:text-secondary-100">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 1.5m1-1.5l1 1.5m0 0l1 1.5m-2-1.5l-1-1.5m-6.375 5.25h14.25" /></svg>
                {{ __('Reports') }}
            </x-nav-link>
        @elseif (Auth::user()->role == 'kasir')
            <x-nav-link :href="route('kasir.transactions.index')" :active="request()->routeIs('kasir.transactions.index')" class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-secondary-800 dark:hover:text-secondary-100">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h6m3-3.75l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V5.25a2.25 2.25 0 00-2.25-2.25H18a2.25 2.25 0 00-2.25 2.25v.75M7.5 14.25h.008v.008H7.5v-.008zm0 2.25h.008v.008H7.5v-.008zm.375 0h.008v.008h-.008v-.008zm.375-2.25h.008v.008h-.008v-.008z" /></svg>
                {{ __('Transactions') }}
            </x-nav-link>
            <x-nav-link :href="route('kasir.reports.index')" :active="request()->routeIs('kasir.reports.index')" class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-secondary-800 dark:hover:text-secondary-100">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 1.5m1-1.5l1 1.5m0 0l1 1.5m-2-1.5l-1-1.5m-6.375 5.25h14.25" /></svg>
                {{ __('Reports') }}
            </x-nav-link>
        @elseif (Auth::user()->role == 'owner')
            <x-nav-link :href="route('owner.reports.index')" :active="request()->routeIs('owner.reports.index')" class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-emerald-50 hover:text-emerald-700 dark:hover:bg-secondary-800 dark:hover:text-secondary-100">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 1.5m1-1.5l1 1.5m0 0l1 1.5m-2-1.5l-1-1.5m-6.375 5.25h14.25" /></svg>
                {{ __('Reports') }}
            </x-nav-link>
        @endif
    </nav>

    <!-- Theme Toggle -->
    <div class="px-4 pb-4 mt-auto">
        <button id="theme-toggle-btn" class="w-full flex items-center p-3 rounded-xl text-left text-sm font-medium text-emerald-900 bg-emerald-50 hover:bg-emerald-100 focus:outline-none transition ease-in-out duration-300 dark:bg-secondary-800 dark:text-secondary-200 dark:hover:bg-secondary-700">
            <svg id="theme-toggle-dark-icon" class="w-6 h-6 mr-3 text-emerald-600 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" /></svg>
            <svg id="theme-toggle-light-icon" class="w-6 h-6 mr-3 text-emerald-600 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.95-4.243l-1.59-1.591M5.25 12H3m4.243-4.95l-1.59-1.591M12 9a3 3 0 100 6 3 3 0 000-6z" /></svg>
            <span class="flex-1 font-medium">Change Theme</span>
        </button>
    </div>

    <!-- User Menu -->
    <div class="px-4 pb-4">
        <x-dropdown align="bottom" width="full">
            <x-slot name="trigger">
                <button class="w-full flex items-center p-3 rounded-xl text-left text-sm font-medium text-emerald-900 bg-emerald-50 hover:bg-emerald-100 focus:outline-none transition ease-in-out duration-300 dark:bg-secondary-800 dark:text-secondary-200 dark:hover:bg-secondary-700">
                    <svg class="w-6 h-6 mr-3 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    <div class="flex-1 font-medium">{{ Auth::user()->name }}</div>
                    <svg class="fill-current h-4 w-4 ml-1 text-emerald-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link 
                        :href="route('logout')" 
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-red-500 hover:bg-red-50 hover:text-red-700 focus:bg-red-50 focus:text-red-700 border-b border-emerald-100 !rounded-t-xl dark:border-secondary-700 dark:text-red-400 dark:hover:bg-red-900/20 dark:hover:text-red-300">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
                
                <x-dropdown-link :href="route('profile.edit')" class="hover:bg-emerald-50 !rounded-b-xl dark:hover:bg-secondary-800">
                    {{ __('Profile') }}
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>
    </div>
</div>
