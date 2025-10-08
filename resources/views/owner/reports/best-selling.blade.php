<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Top 10 Best-Selling Menu Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4 no-print">
                        <a href="{{ route('owner.reports.index') }}" class="text-blue-500 hover:text-blue-700">&larr; Back to Sales Reports</a>
                        <button type="button" onclick="window.print()" class="ml-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Print to PDF
                        </button>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rank</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Menu Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Sold</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($bestSellingMenus as $index => $menu)
                                <tr>
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">{{ $menu->nama_menu }}</td>
                                    <td class="px-6 py-4">{{ $menu->total_quantity }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">No sales data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>