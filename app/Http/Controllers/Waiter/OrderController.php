<?php

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
        // PERBAIKAN KECIL: Menampilkan SEMUA pesanan aktif, bukan hanya 'pending'
        $orders = Order::with(['customer', 'restaurantTable'])
            ->where('user_id', $request->user()->id)
            ->whereNotIn('status', ['completed', 'paid']) // Menampilkan pending, cooking, ready, served
            ->latest()
            ->paginate(10); // Menambahkan paginasi untuk performa

        return view('waiter.orders.index', compact('orders'));
    }

    public function select_table()
    {
        $tables = RestaurantTable::all(); // Menampilkan semua meja agar waiter tahu statusnya
        return view('waiter.orders.select-table', compact('tables'));
    }

    public function create(Request $request)
    {
        $table = RestaurantTable::findOrFail($request->table_id);
        
        // Mencegah pembuatan pesanan di meja yang sudah terisi
        if ($table->status !== 'available') {
            return redirect()->route('waiter.orders.select_table')->with('danger', 'Table is currently occupied.');
        }

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
            $menus = $request->input('menus', []);
            
            if (empty(array_filter($menus))) {
                // Melemparkan exception untuk membatalkan transaksi jika tidak ada menu yang dipilih
                throw new \Exception('Cannot create an order with no menu items.');
            }

            foreach ($menus as $menuId => $quantity) {
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

    // --- METODE BARU DITAMBAHKAN DI SINI ---
    
    /**
     * Update the status of a specific order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Order $order)
    {
        // Validasi untuk memastikan status yang dikirim adalah salah satu dari yang diizinkan
        $request->validate([
            'status' => 'required|in:cooking,ready,served',
        ]);

        // Logika sederhana untuk mencegah status "mundur"
        $statusHierarchy = ['pending' => 1, 'cooking' => 2, 'ready' => 3, 'served' => 4];
        if ($statusHierarchy[$request->status] <= $statusHierarchy[$order->status]) {
            return back()->with('danger', 'Cannot revert order status.');
        }

        // Update status pesanan
        $order->update([
            'status' => $request->status,
        ]);

        // Kembali ke halaman detail dengan pesan sukses
        return redirect()->route('waiter.orders.show', $order)
                         ->with('success', 'Order status updated to "' . ucfirst($request->status) . '".');
    }
}