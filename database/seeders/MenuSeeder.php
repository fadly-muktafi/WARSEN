<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create(['nama_menu' => 'Nasi Goreng Spesial', 'harga' => 25000]);
        Menu::create(['nama_menu' => 'Mie Ayam Bakso', 'harga' => 20000]);
        Menu::create(['nama_menu' => 'Sate Ayam', 'harga' => 30000]);
        Menu::create(['nama_menu' => 'Gado-Gado', 'harga' => 18000]);
        Menu::create(['nama_menu' => 'Es Teh Manis', 'harga' => 5000]);
        Menu::create(['nama_menu' => 'Jus Jeruk', 'harga' => 10000]);
    }
}