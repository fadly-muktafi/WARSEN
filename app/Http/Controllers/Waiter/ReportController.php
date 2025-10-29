<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon; // Lebih baik mengimpor Carbon
use Illuminate\Support\Facades\Auth; // Lebih baik mengimpor Auth

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Menentukan rentang tanggal dari input, dengan nilai default hari ini
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->startOfDay() : Carbon::now()->startOfDay();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : Carbon::now()->endOfDay();

        // 1. Buat query dasar untuk mendapatkan semua pesanan dalam rentang tanggal
        $baseQuery = Order::where('user_id', Auth::id())
                          ->whereBetween('created_at', [$startDate, $endDate]);

        // 2. Hitung total DARI KESELURUHAN data (sebelum paginasi)
        // Kita perlu meng-clone query agar tidak terpengaruh oleh paginasi
        $totalSales = (clone $baseQuery)->sum('total_amount');
        $totalOrders = (clone $baseQuery)->count();

        // 3. SEKARANG, terapkan paginasi pada query untuk ditampilkan di tabel
        // Eager load relasi untuk performa yang baik
        $orders = $baseQuery->with(['customer', 'restaurantTable'])
                            ->latest() // 'latest()' adalah singkatan dari 'orderBy('created_at', 'desc')'
                            ->paginate(10) // Menghasilkan Paginator, 10 item per halaman
                            ->withQueryString(); // Memastikan filter tanggal tetap ada saat berpindah halaman

        // Kirim semua data ke view
        return view('waiter.reports.index', compact('orders', 'totalSales', 'totalOrders', 'startDate', 'endDate'));
    }
}