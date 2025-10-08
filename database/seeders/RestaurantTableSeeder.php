<?php

namespace Database\Seeders;

use App\Models\RestaurantTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            RestaurantTable::create([
                'nomor_meja' => 'M' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'status' => 'available',
            ]);
        }
    }
}