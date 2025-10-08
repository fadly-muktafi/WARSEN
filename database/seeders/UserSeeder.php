<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@resto.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Waiter User',
            'email' => 'waiter@resto.com',
            'role' => 'waiter',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Cashier User',
            'email' => 'kasir@resto.com',
            'role' => 'kasir',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Owner User',
            'email' => 'owner@resto.com',
            'role' => 'owner',
            'password' => Hash::make('password'),
        ]);
    }
}