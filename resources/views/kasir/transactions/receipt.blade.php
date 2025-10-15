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
                display: none !important;
            }
            .print-container {
                box-shadow: none !important;
                margin: 0 !important;
                background: white !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto my-8 p-6 bg-white shadow-md max-w-sm print-container">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-primary-700">My Restaurant</h1>
            <p class="text-gray-600">123 Culinary Lane, Food City</p>
            <p class="text-gray-500 text-sm mt-1">Telp: (021) 12345678</p>
        </div>

        <div class="border-t border-b border-gray-200 py-4">
            <div class="flex justify-between text-sm mb-1">
                <span class="text-gray-600">Order ID:</span>
                <span class="font-medium">#{{ $transaction->id }}</span>
            </div>
            <div class="flex justify-between text-sm mb-1">
                <span class="text-gray-600">Date:</span>
                <span class="font-medium">{{ $transaction->updated_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between text-sm mb-1">
                <span class="text-gray-600">Cashier:</span>
                <span class="font-medium">{{ $transaction->user->name ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-600">Table:</span>
                <span class="font-medium">{{ $transaction->restaurant_table_name ?? ($transaction->restaurant_table_id ?? 'N/A') }}</span>
            </div>
        </div>

        <div class="py-4">
            @foreach ($transaction->orderDetails as $detail)
                <div class="flex justify-between items-start text-sm mb-3">
                    <div class="flex-1">
                        <p class="font-medium">{{ $detail->menu->name }}</p>
                        <p class="text-gray-500 text-xs">{{ $detail->jumlah }} x Rp {{ number_format($detail->harga, 0, ',', '.') }}</p>
                    </div>
                    <span class="font-medium">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>

        <div class="border-t border-gray-200 pt-4 space-y-2">
            <div class="flex justify-between">
                <span class="text-gray-600">Subtotal</span>
                <span class="font-medium">Rp {{ number_format($transaction->total_amount - ($transaction->tax_amount ?? 0) - ($transaction->service_charge ?? 0), 0, ',', '.') }}</span>
            </div>
            
            @if($transaction->tax_amount > 0)
            <div class="flex justify-between">
                <span class="text-gray-600">Tax ({{ $transaction->tax_percentage ?? 10 }}%)</span>
                <span class="font-medium">Rp {{ number_format($transaction->tax_amount ?? 0, 0, ',', '.') }}</span>
            </div>
            @endif
            
            @if($transaction->service_charge > 0)
            <div class="flex justify-between">
                <span class="text-gray-600">Service Charge</span>
                <span class="font-medium">Rp {{ number_format($transaction->service_charge ?? 0, 0, ',', '.') }}</span>
            </div>
            @endif
            
            <div class="flex justify-between font-bold text-lg pt-2 border-t border-gray-200">
                <span>Total</span>
                <span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
            </div>
            
            <div class="flex justify-between text-sm mt-2">
                <span class="text-gray-600">Paid</span>
                <span class="font-medium">Rp {{ number_format($transaction->bayar, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-600">Change</span>
                <span class="font-medium">Rp {{ number_format($transaction->kembalian, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="text-center mt-6">
            <p class="text-gray-600 italic">Thank you for your visit!</p>
            <p class="text-gray-500 text-xs mt-2">We hope to serve you again soon</p>
        </div>

        <div class="mt-8 text-center no-print space-x-2">
            <button onclick="window.print()" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                Print Receipt
            </button>
            <a href="{{ route('kasir.transactions.index') }}" class="bg-secondary-500 hover:bg-secondary-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                Back to Orders
            </a>
        </div>
    </div>
</body>
</html>