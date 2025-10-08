<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['customer', 'restaurantTable'])
            ->where('user_id', $request->user()->id)
            ->where('status', 'pending')
            ->latest()
            ->get();
        return view('waiter.orders.index', compact('orders'));
    }

    public function select_table()
    {
        $tables = RestaurantTable::where('status', 'available')->get();
        return view('waiter.orders.select-table', compact('tables'));
    }

    public function create(Request $request)
    {
        $table = RestaurantTable::findOrFail($request->table_id);
        $menus = Menu::all();
        return view('waiter.orders.create', compact('table', 'menus'));
    }

    public function show(Order $order)
    {
        $order->load('customer', 'restaurantTable', 'orderDetails.menu');
        return view('waiter.orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'jumlah_pelanggan' => 'required|integer|min:1',
            'table_id' => 'required|exists:restaurant_tables,id',
            'menus' => 'required|array',
            'menus.*' => 'integer|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $customer = Customer::create([
                'nama_pelanggan' => $request->customer_name,
                'jumlah_pelanggan' => $request->jumlah_pelanggan,
                'restaurant_table_id' => $request->table_id,
            ]);

            $order = Order::create([
                'customer_id' => $customer->id,
                'restaurant_table_id' => $request->table_id,
                'user_id' => $request->user()->id,
                'status' => 'pending',
            ]);

            $totalAmount = 0;
            foreach ($request->menus as $menuId => $quantity) {
                if ($quantity > 0) {
                    $menu = Menu::find($menuId);
                    $subtotal = $menu->harga * $quantity;
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'menu_id' => $menuId,
                        'jumlah' => $quantity,
                        'harga' => $menu->harga,
                        'subtotal' => $subtotal,
                    ]);
                    $totalAmount += $subtotal;
                }
            }

            $order->update(['total_amount' => $totalAmount]);

            $table = RestaurantTable::find($request->table_id);
            $table->update(['status' => 'occupied']);
        });

        return redirect()->route('waiter.orders.index')->with('success', 'Order created successfully.');
    }
}
