<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - Order #{{ $transaction->id }}</title>
    
    {{-- Menggunakan Vite untuk konsistensi --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Menggunakan font monospace untuk angka agar terlihat rapi */
        body {
            font-family: 'Inter', sans-serif;
        }
        .font-mono {
            font-family: 'ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', "Liberation Mono", "Courier New", monospace;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
            .print-container {
                box-shadow: none !important;
                margin: 0 auto !important;
                padding: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                background-color: white !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100">

    {{-- Tombol aksi di luar area cetak --}}
    <div class="max-w-sm mx-auto my-8 px-4 sm:px-0 no-print">
        <div class="flex justify-between space-x-3">
            <a href="{{ route('kasir.transactions.index') }}" class="w-full justify-center inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                &larr; Back
            </a>
            <button onclick="window.print()" class="w-full justify-center inline-flex items-center px-4 py-2 bg-slate-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-700">
                <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659" /></svg>
                Print
            </button>
        </div>
    </div>

    {{-- Konten Struk --}}
    <div class="container mx-auto p-6 bg-white shadow-lg max-w-sm print-container font-mono text-sm">
        
        <div class="text-center mb-6">
            <h1 class="text-xl font-bold font-sans">WARSEN</h1>
            <p class="text-gray-600 text-xs font-sans">Jl. Jendral Sudirman No. 123, Jakarta</p>
            <p class="text-gray-500 text-xs font-sans">Telp: (021) 123-4567</p>
        </div>

        {{-- Detail Transaksi --}}
        <div class="border-t border-b border-dashed border-gray-300 py-2 mb-4">
            <div class="flex justify-between"><span>Order ID</span> <span>#{{ $transaction->id }}</span></div>
            <div class="flex justify-between"><span>Date</span> <span>{{ $transaction->updated_at->format('d/m/y H:i') }}</span></div>
            <div class="flex justify-between"><span>Cashier</span> <span>{{ $transaction->user->name ?? 'N/A' }}</span></div>
            <div class="flex justify-between"><span>Table</span> <span>{{ $transaction->restaurantTable->nomor_meja ?? 'N/A' }}</span></div>
        </div>

        {{-- Daftar Item --}}
        <div class="mb-4">
            @foreach ($transaction->orderDetails as $detail)
                <div class="mb-2">
                    <p class="font-sans font-medium">{{ $detail->menu->nama_menu }}</p>
                    <div class="flex justify-between">
                        <span class="text-gray-600">{{ $detail->jumlah }} x {{ number_format($detail->harga, 0, ',', '.') }}</span>
                        <span>{{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Kalkulasi Total --}}
        <div class="border-t border-dashed border-gray-300 pt-2 space-y-1">
            {{-- Bagian ini bisa disesuaikan jika Anda memiliki pajak/service charge --}}
            <div class="flex justify-between"><span class="font-sans text-gray-600">Subtotal</span> <span>{{ number_format($transaction->total_amount, 0, ',', '.') }}</span></div>
            
            <div class="flex justify-between font-bold text-base pt-2 border-t border-dashed border-gray-300">
                <span class="font-sans">TOTAL</span>
                <span>{{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
            </div>
            
            <div class="flex justify-between pt-2"><span class="font-sans text-gray-600">Paid Amount</span> <span>{{ number_format($transaction->bayar, 0, ',', '.') }}</span></div>
            <div class="flex justify-between"><span class="font-sans text-gray-600">Change</span> <span>{{ number_format($transaction->kembalian, 0, ',', '.') }}</span></div>
        </div>

        {{-- Pesan Penutup --}}
        <div class="text-center mt-6">
            <p class="text-gray-600 text-xs font-sans italic">Thank You!</p>
        </div>
    </div>

</body>
</html>