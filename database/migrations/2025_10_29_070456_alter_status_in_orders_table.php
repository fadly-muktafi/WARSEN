<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Mengubah kolom status untuk mengizinkan semua nilai yang diperlukan
            $table->enum('status', [
                'pending', 
                'cooking', 
                'ready', 
                'served', 
                'completed', 
                'cancelled' // Menambahkan 'cancelled' juga merupakan praktik yang baik
            ])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Kode untuk mengembalikan ke kondisi semula jika diperlukan
            $table->enum('status', ['pending', 'completed'])->default('pending')->change();
        });
    }
};