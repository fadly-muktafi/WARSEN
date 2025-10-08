<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = \Carbon\Carbon::parse($request->input('start_date', now()))->startOfDay();
        $endDate = \Carbon\Carbon::parse($request->input('end_date', now()))->endOfDay();

        $orders = Order::with(['customer', 'restaurantTable'])
            ->where('user_id', auth()->id())
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        $totalSales = $orders->sum('total_amount');
        $totalOrders = $orders->count();

        return view('waiter.reports.index', compact('orders', 'totalSales', 'totalOrders', 'startDate', 'endDate'));
    }
}
