<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu; // Impor model Menu
use App\Models\User; // Impor model User
// Asumsi Anda memiliki model Order untuk transaksi. Jika tidak, ganti dengan model yang sesuai.
use App\Models\Order; 
use Illuminate\Http\Request;
use Illuminate\Support\Carbon; // Impor Carbon untuk manipulasi tanggal
use Illuminate\Support\Facades\DB; // Impor DB facade untuk query yang lebih kompleks

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        // === Data untuk Stat Cards ===

        // 1. Menghitung total menu
        $totalMenus = Menu::count();

        // 2. Menghitung total pengguna/staff
        $totalUsers = User::count();

        // 3. Menghitung total pendapatan dan pesanan hari ini
        // Asumsi: Model 'Order' memiliki kolom 'total_price' dan 'created_at'
        $today = Carbon::today();
        $todayOrders = Order::whereDate('created_at', $today)->count();
        $totalRevenue = Order::whereDate('created_at', $today)->sum('total_amount');

        
        // === Data untuk Grafik Penjualan Mingguan ===

        // Menyiapkan data untuk 7 hari terakhir
        $salesData = Order::query()
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(6)) // Mulai dari 6 hari yang lalu sampai hari ini
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->pluck('total', 'date'); // Hasilnya: ['2025-10-23' => 150000, '2025-10-24' => 200000, ...]

        // Membuat label dan data untuk grafik, memastikan semua 7 hari ada (termasuk yang penjualannya 0)
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateString = $date->format('Y-m-d');
            
            // Menambahkan label (misal: "Wed", "Thu", "Fri")
            $chartLabels[] = $date->format('D'); // D = Mon, Tue, Wed, ...
            
            // Menambahkan data penjualan untuk tanggal tersebut, atau 0 jika tidak ada penjualan
            $chartData[] = $salesData->get($dateString, 0);
        }


        // Mengirim semua data yang telah dihitung ke view
        return view('admin.dashboard', [
            'totalMenus' => $totalMenus,
            'totalUsers' => $totalUsers,
            'todayOrders' => $todayOrders,
            'totalRevenue' => $totalRevenue,
            'chartLabels' => json_encode($chartLabels), // Kirim sebagai JSON string
            'chartData' => json_encode($chartData),     // Kirim sebagai JSON string
        ]);
    }
}