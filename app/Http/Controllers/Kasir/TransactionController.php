<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer', 'restaurantTable')->where('status', 'pending')->latest()->paginate(10);
        return view('kasir.transactions.index', compact('orders'));
    }

    public function show(Order $transaction)
    {
        $transaction->load('customer', 'restaurantTable', 'orderDetails.menu');
        return view('kasir.transactions.show', compact('transaction'));
    }

    public function receipt(Order $transaction)
    {
        $transaction->load('customer', 'restaurantTable', 'orderDetails.menu');
        return view('kasir.transactions.receipt', compact('transaction'));
    }

    public function update(Request $request, Order $transaction)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:' . $transaction->total_amount,
        ]);

        DB::transaction(function () use ($request, $transaction) {
            $change = $request->amount_paid - $transaction->total_amount;

            $transaction->update([
                'status' => 'completed',
                'bayar' => $request->amount_paid,
                'kembalian' => $change,
            ]);

            if ($transaction->restaurantTable) {
                $transaction->restaurantTable->update(['status' => 'available']);
            }
        });

        return redirect()->route('kasir.transactions.receipt', $transaction);
    }
}