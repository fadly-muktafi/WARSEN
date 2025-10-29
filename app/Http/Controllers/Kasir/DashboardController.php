<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        // === Data untuk Stat Cards ===

        // 1. Jumlah pesanan yang menunggu pembayaran (status 'served') - INI SUDAH BENAR
        $pendingPaymentsCount = Order::where('status', 'served')->count();

        // --- PERBAIKAN LOGIKA DI SINI ---

        // 2. Total transaksi yang diselesaikan HARI INI oleh kasir MANAPUN
        $todayTransactionsCount = Order::where('status', 'completed') // <<< PERBAIKAN 1: Mencari status 'completed'
                                       ->whereDate('updated_at', Carbon::today())
                                       ->count();
        
        // 3. Total pendapatan yang diterima HARI INI dari semua transaksi yang selesai
        $todayRevenue = Order::where('status', 'completed') // <<< PERBAIKAN 2: Mencari status 'completed'
                               ->whereDate('updated_at', Carbon::today())
                               ->sum('total_amount');

        // === Data untuk Daftar Tugas (Actionable Lists) ===

        // 1. Daftar 5 pesanan teratas yang menunggu pembayaran - INI SUDAH BENAR
        $pendingPaymentsList = Order::with(['customer', 'restaurantTable'])
                                    ->where('status', 'served')
                                    ->orderBy('updated_at', 'asc')
                                    ->limit(5)
                                    ->get();

        // 2. Daftar 5 transaksi terakhir yang diselesaikan hari ini oleh KASIR INI
        $myCompletedTransactionsList = Order::with(['customer', 'restaurantTable'])
                                            ->where('status', 'completed') // <<< PERBAIKAN 3: Mencari status 'completed'
                                            ->where('user_id', Auth::id()) // Filter hanya transaksi milik kasir yg login
                                            ->whereDate('updated_at', Carbon::today())
                                            ->orderBy('updated_at', 'desc')
                                            ->limit(5)
                                            ->get();

        // Mengirim semua data ke view
        return view('kasir.dashboard', [
            'pendingPaymentsCount' => $pendingPaymentsCount,
            'todayTransactionsCount' => $todayTransactionsCount,
            'todayRevenue' => $todayRevenue,
            'pendingPaymentsList' => $pendingPaymentsList,
            'completedTransactionsList' => $myCompletedTransactionsList, // Mengirim variabel yang benar
        ]);
    }
}