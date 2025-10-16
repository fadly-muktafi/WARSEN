<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-emerald-800 leading-tight dark:text-secondary-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl shadow-lg mb-8 overflow-hidden">
                <div class="p-8 text-white">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div>
                            <h1 class="text-3xl font-bold">Welcome back, {{ Auth::user()->name }}!</h1>
                            <p class="mt-2 text-emerald-100">Manage your restaurant business efficiently</p>
                        </div>
                        <div class="mt-4 md:mt-0 bg-white/20 px-6 py-3 rounded-xl">
                            <p class="text-lg font-medium">{{ date('l, F j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-md p-6 border border-emerald-100 transition-transform duration-300 hover:scale-105 dark:bg-secondary-800 dark:border-secondary-700">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-emerald-100 text-emerald-600 dark:bg-emerald-900/50 dark:text-emerald-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-emerald-600 dark:text-emerald-400">Total Orders</h3>
                            <p class="text-2xl font-bold text-gray-800 dark:text-secondary-200">128</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6 border border-emerald-100 transition-transform duration-300 hover:scale-105 dark:bg-secondary-800 dark:border-secondary-700">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-amber-100 text-amber-600 dark:bg-amber-900/50 dark:text-amber-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-amber-600 dark:text-amber-400">Revenue</h3>
                            <p class="text-2xl font-bold text-gray-800 dark:text-secondary-200">Rp 45.2M</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6 border border-emerald-100 transition-transform duration-300 hover:scale-105 dark:bg-secondary-800 dark:border-secondary-700">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-blue-600 dark:text-blue-400">Customers</h3>
                            <p class="text-2xl font-bold text-gray-800 dark:text-secondary-200">246</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-md p-6 border border-emerald-100 transition-transform duration-300 hover:scale-105 dark:bg-secondary-800 dark:border-secondary-700">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-violet-100 text-violet-600 dark:bg-violet-900/50 dark:text-violet-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-violet-600 dark:text-violet-400">Completed</h3>
                            <p class="text-2xl font-bold text-gray-800 dark:text-secondary-200">112</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity and Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Activity -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-emerald-100 dark:bg-secondary-800 dark:border-secondary-700">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 dark:text-secondary-200">Recent Orders</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 hover:bg-emerald-50 rounded-lg transition duration-200 dark:hover:bg-secondary-700/50">
                            <div class="flex items-center">
                                <div class="p-2 rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-900/50 dark:text-emerald-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-800 dark:text-secondary-200">#ORD-001</p>
                                    <p class="text-sm text-gray-600 dark:text-secondary-400">John Doe</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-300">Pending</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 hover:bg-emerald-50 rounded-lg transition duration-200 dark:hover:bg-secondary-700/50">
                            <div class="flex items-center">
                                <div class="p-2 rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-900/50 dark:text-emerald-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-800 dark:text-secondary-200">#ORD-002</p>
                                    <p class="text-sm text-gray-600 dark:text-secondary-400">Jane Smith</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">Completed</span>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 hover:bg-emerald-50 rounded-lg transition duration-200 dark:hover:bg-secondary-700/50">
                            <div class="flex items-center">
                                <div class="p-2 rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-900/50 dark:text-emerald-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-medium text-gray-800 dark:text-secondary-200">#ORD-003</p>
                                    <p class="text-sm text-gray-600 dark:text-secondary-400">Robert Johnson</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">In Progress</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-md p-6 border border-emerald-100 dark:bg-secondary-800 dark:border-secondary-700">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 dark:text-secondary-200">Quick Actions</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="#" class="flex flex-col items-center justify-center p-6 bg-emerald-50 rounded-xl border border-emerald-200 hover:bg-emerald-100 transition duration-300 dark:bg-secondary-700/50 dark:border-secondary-700 dark:hover:bg-secondary-700">
                            <div class="p-3 rounded-full bg-emerald-100 text-emerald-600 mb-2 dark:bg-emerald-900/50 dark:text-emerald-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700 dark:text-secondary-300">New Order</span>
                        </a>
                        
                        <a href="#" class="flex flex-col items-center justify-center p-6 bg-amber-50 rounded-xl border border-amber-200 hover:bg-amber-100 transition duration-300 dark:bg-secondary-700/50 dark:border-secondary-700 dark:hover:bg-secondary-700">
                            <div class="p-3 rounded-full bg-amber-100 text-amber-600 mb-2 dark:bg-amber-900/50 dark:text-amber-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700 dark:text-secondary-300">View Reports</span>
                        </a>
                        
                        <a href="#" class="flex flex-col items-center justify-center p-6 bg-blue-50 rounded-xl border border-blue-200 hover:bg-blue-100 transition duration-300 dark:bg-secondary-700/50 dark:border-secondary-700 dark:hover:bg-secondary-700">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mb-2 dark:bg-blue-900/50 dark:text-blue-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700 dark:text-secondary-300">Manage Users</span>
                        </a>
                        
                        <a href="#" class="flex flex-col items-center justify-center p-6 bg-violet-50 rounded-xl border border-violet-200 hover:bg-violet-100 transition duration-300 dark:bg-secondary-700/50 dark:border-secondary-700 dark:hover:bg-secondary-700">
                            <div class="p-3 rounded-full bg-violet-100 text-violet-600 mb-2 dark:bg-violet-900/50 dark:text-violet-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700 dark:text-secondary-300">Settings</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
