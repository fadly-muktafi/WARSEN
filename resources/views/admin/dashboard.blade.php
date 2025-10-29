<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Welcome Banner --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p class="mt-1 text-gray-600">Here's a snapshot of your restaurant's activity today.</p>
                </div>
            </div>

            {{-- Stat Cards Grid --}}
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                
                <!-- Card 1: Total Revenue -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1m0 1H9m3 0h3m-3 12v-1m0 1c-1.11 0-2.08-.402-2.599-1M12 18v-1m0 1h3m-3 0H9" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 truncate">Today's Revenue</dt>
                            <dd class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</dd>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Total Orders -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                             <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 truncate">Today's Orders</dt>
                            <dd class="text-2xl font-semibold text-gray-900">{{ $todayOrders }}</dd>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Total Menus -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-orange-500 rounded-md p-3">
                           <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Menus</dt>
                            <dd class="text-2xl font-semibold text-gray-900">{{ $totalMenus }}</dd>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Total Users -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                     <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                           <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <div class="ml-4">
                            <dt class="text-sm font-medium text-gray-500 truncate">Staff & Users</dt>
                            <dd class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</dd>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Chart and Recent Activity Section --}}
            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
                
                <!-- Sales Chart -->
                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                         <h3 class="text-lg font-medium text-gray-900">Weekly Sales Overview</h3>
                         <div class="mt-4" style="height: 300px;">
                             {{-- PERBAIKAN: Menambahkan atribut data-* untuk menyimpan data chart --}}
                             <canvas 
                                id="salesChart" 
                                data-labels="{{ $chartLabels }}"
                                data-values="{{ $chartData }}"
                             ></canvas>
                         </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="lg:col-span-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                        <ul role="list" class="mt-4 space-y-3">
                            <li>
                                <a href="{{ route('admin.menus.create') }}" class="flex items-center p-3 text-sm font-medium text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition ease-in-out duration-150"><svg class="h-5 w-5 mr-3 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>Add New Menu</a>
                            </li>
                             <li>
                                <a href="{{ route('admin.tables.create') }}" class="flex items-center p-3 text-sm font-medium text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition ease-in-out duration-150"><svg class="h-5 w-5 mr-3 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>Add New Table</a>
                            </li>
                             <li>
                                <a href="{{ route('admin.users.create') }}" class="flex items-center p-3 text-sm font-medium text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition ease-in-out duration-150"><svg class="h-5 w-5 mr-3 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>Add New User</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Script untuk Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mengambil elemen canvas
        const salesChartCanvas = document.getElementById('salesChart');
        
        // PERBAIKAN: Membaca data dari atribut data-* dan mem-parsingnya sebagai JSON
        const chartLabels = JSON.parse(salesChartCanvas.dataset.labels);
        const chartData = JSON.parse(salesChartCanvas.dataset.values);

        new Chart(salesChartCanvas, {
            type: 'bar',
            data: {
                labels: chartLabels, 
                datasets: [{
                    label: 'Sales (Rp)',
                    data: chartData,
                    backgroundColor: 'rgba(79, 70, 229, 0.8)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) { label += ': '; }
                                if (context.parsed.y !== null) {
                                    label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>