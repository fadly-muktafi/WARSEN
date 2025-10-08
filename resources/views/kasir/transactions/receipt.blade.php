<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - Order #{{ $transaction->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto my-8 p-4 bg-white shadow-md max-w-sm">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold">My Restaurant</h1>
            <p class="text-gray-600">123 Culinary Lane, Food City</p>
        </div>

        <div class="border-t border-b border-dashed py-4">
            <div class="flex justify-between text-sm">
                <span>Order ID:</span>
                <span>#{{ $transaction->id }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span>Date:</span>
                <span>{{ $transaction->updated_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span>Cashier:</span>
                <span>{{ $transaction->user->name ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span>Table:</span>
                <span>{{ $transaction->restaurant_table_id ?? 'N/A' }}</span>
            </div>
        </div>

        <div class="py-4">
            @foreach ($transaction->orderDetails as $detail)
                <div class="flex justify-between items-center text-sm mb-2">
                    <div>
                        <p>{{ $detail->menu->name }}</p>
                        <p class="text-gray-500">{{ $detail->jumlah }} x Rp {{ number_format($detail->harga, 0, ',', '.') }}</p>
                    </div>
                    <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>

        <div class="border-t border-dashed pt-4">
            <div class="flex justify-between font-semibold">
                <span>Total</span>
                <span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm mt-1">
                <span>Paid</span>
                <span>Rp {{ number_format($transaction->bayar, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span>Change</span>
                <span>Rp {{ number_format($transaction->kembalian, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="text-center mt-8">
            <p class="text-gray-600">Thank you for your visit!</p>
        </div>

        <div class="mt-8 text-center no-print">
            <button onclick="window.print()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Print Receipt
            </button>
            <a href="{{ route('kasir.transactions.index') }}" class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Orders
            </a>
        </div>
    </div>
</body>
</html>