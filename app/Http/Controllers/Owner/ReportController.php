<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = \Carbon\Carbon::parse($request->input('start_date', now()))->startOfDay();
        $endDate = \Carbon\Carbon::parse($request->input('end_date', now()))->endOfDay();

        $orders = Order::with(['customer', 'restaurantTable', 'user'])
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->latest()
            ->get();

        $totalSales = $orders->sum('total_amount');
        $totalTransactions = $orders->count();

        return view('owner.reports.index', compact('orders', 'totalSales', 'totalTransactions', 'startDate', 'endDate'));
    }

    public function bestSelling(Request $request)
    {
        $bestSellingMenus = OrderDetail::select('menus.nama_menu', DB::raw('SUM(order_details.jumlah) as total_quantity'))
            ->join('menus', 'order_details.menu_id', '=', 'menus.id')
            ->groupBy('menus.nama_menu')
            ->orderBy('total_quantity', 'desc')
            ->limit(10)
            ->get();

        return view('owner.reports.best-selling', compact('bestSellingMenus'));
    }
}
