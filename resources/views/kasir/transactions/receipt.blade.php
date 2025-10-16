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
        
        @media screen and (min-width: 768px) {
            .print-container {
                width: 22rem;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-emerald-50 to-cyan-50 font-sans">
    <div class="container mx-auto my-8 p-6 bg-white shadow-lg rounded-2xl max-w-sm print-container">
        <div class="text-center mb-6">
            <div class="flex justify-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-emerald-800">LaundryPro</h1>
            <p class="text-emerald-600">123 Clean Street, Fresh City</p>
            <p class="text-emerald-500 text-sm mt-1">Telp: (021) 555-6789</p>
        </div>

        <div class="border-t border-b border-emerald-100 py-4">
            <div class="flex justify-between text-sm mb-1">
                <span class="text-gray-600">Order ID:</span>
                <span class="font-medium text-emerald-700">#{{ $transaction->id }}</span>
            </div>
            <div class="flex justify-between text-sm mb-1">
                <span class="text-gray-600">Date:</span>
                <span class="font-medium">{{ $transaction->updated_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between text-sm mb-1">
                <span class="text-gray-600">Staff:</span>
                <span class="font-medium">{{ $transaction->user->name ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-600">Customer:</span>
                <span class="font-medium">{{ $transaction->customer->nama_pelanggan ?? 'N/A' }}</span>
            </div>
        </div>

        <div class="py-4">
            @foreach ($transaction->orderDetails as $detail)
                <div class="flex justify-between items-start text-sm mb-3">
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">{{ $detail->menu->name }}</p>
                        <p class="text-gray-500 text-xs">{{ $detail->jumlah }} x Rp {{ number_format($detail->harga, 0, ',', '.') }}</p>
                    </div>
                    <span class="font-medium text-emerald-600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>

        <div class="border-t border-emerald-100 pt-4 space-y-2">
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
            
            <div class="flex justify-between font-bold text-lg pt-2 border-t border-emerald-100">
                <span class="text-gray-800">Total</span>
                <span class="text-emerald-700">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
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
            <p class="text-emerald-600 font-medium">Thank you for using our service!</p>
            <p class="text-gray-500 text-xs mt-2">We hope to see you again soon</p>
        </div>

        <div class="mt-8 text-center no-print space-x-2">
            <button onclick="window.print()" class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-medium py-3 px-4 rounded-xl transition duration-300 transform hover:scale-105 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Receipt
            </button>
            <a href="{{ route('kasir.transactions.index') }}" class="bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-medium py-3 px-4 rounded-xl transition duration-300 transform hover:scale-105 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Orders
            </a>
        </div>
    </div>
</body>
</html>