<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Menentukan rentang tanggal dari input, dengan nilai default hari ini
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->startOfDay() : Carbon::now()->startOfDay();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : Carbon::now()->endOfDay();

        // --- PERBAIKAN LOGIKA UTAMA DI SINI ---
        // 1. Buat query dasar untuk mendapatkan SEMUA transaksi yang telah selesai ('completed')
        //    tanpa mempedulikan siapa yang memprosesnya.
        $baseQuery = Order::where('status', 'completed')
                          ->whereBetween('updated_at', [$startDate, $endDate]);

        // 2. Hitung total statistik DARI KESELURUHAN data (sebelum paginasi)
        $totalSales = (clone $baseQuery)->sum('total_amount');
        $totalTransactions = (clone $baseQuery)->count();

        // 3. SEKARANG, terapkan paginasi pada query untuk ditampilkan di tabel
        $orders = $baseQuery->with(['customer', 'restaurantTable', 'user']) // 'user' tetap di-load untuk ditampilkan di tabel
                            ->latest('updated_at')
                            ->paginate(10)
                            ->withQueryString();

        // Kirim semua data ke view
        return view('kasir.reports.index', compact('orders', 'totalSales', 'totalTransactions', 'startDate', 'endDate'));
    }
}