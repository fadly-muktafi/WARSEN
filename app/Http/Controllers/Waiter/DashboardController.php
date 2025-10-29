<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use App\Models\Order;
// PERBAIKAN 1: Menggunakan nama model yang benar
use App\Models\RestaurantTable; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $waiterId = Auth::id();

        // === Data untuk Stat Cards ===

        // Menggunakan model RestaurantTable
        $availableTables = RestaurantTable::where('status', 'available')->count();
        
        $myActiveOrders = Order::where('user_id', $waiterId)
                                ->whereNotIn('status', ['paid', 'completed'])
                                ->count();

        $ordersReadyToServe = Order::where('status', 'ready')->count();

        // === Data untuk Daftar Tugas (Actionable Lists) ===
        
        // PERBAIKAN 2: Menggunakan nama relasi yang benar ('restaurantTable')
        $readyOrdersList = Order::with('restaurantTable')
                                ->where('status', 'ready')
                                ->orderBy('created_at', 'asc')
                                ->limit(5)
                                ->get();
        
        // PERBAIKAN 3: Menggunakan nama relasi yang benar ('restaurantTable')
        $myRecentOrdersList = Order::with('restaurantTable')
                                   ->where('user_id', $waiterId)
                                   ->whereNotIn('status', ['paid', 'completed'])
                                   ->orderBy('created_at', 'desc')
                                   ->limit(5)
                                   ->get();

        return view('waiter.dashboard', [
            'availableTables' => $availableTables,
            'myActiveOrders' => $myActiveOrders,
            'ordersReadyToServe' => $ordersReadyToServe,
            'readyOrdersList' => $readyOrdersList,
            'myRecentOrdersList' => $myRecentOrdersList,
        ]);
    }
}