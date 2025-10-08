<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->startOfDay() : now()->startOfDay();
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : now()->endOfDay();

        $orders = Order::with('customer', 'restaurantTable')
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->latest()
            ->get();

        $totalSales = $orders->sum('total_amount');
        $totalTransactions = $orders->count();

        return view('kasir.reports.index', compact('orders', 'totalSales', 'totalTransactions', 'startDate', 'endDate'));
    }
}
