<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Penjual (Seller/Admin)
        User::factory()->create([
            'name' => 'Pemilik Toko (Penjual)',
            'email' => 'penjual@kawanniaga.test',
            'password' => Hash::make('password'),
            'role' => 'penjual',
        ]);

        // Create Pembeli (Buyer)
        User::factory()->create([
            'name' => 'Pelanggan Setia (Pembeli)',
            'email' => 'pembeli@kawanniaga.test',
            'password' => Hash::make('password'),
            'role' => 'pembeli',
        ]);

        // Create Sample Products
        Product::create([
            'name' => 'Aice Mochi',
            'category' => 'Ice Cream',
            'stock' => 50,
            'capital_price' => 2000,
            'selling_price' => 3000,
        ]);

        Product::create([
            'name' => 'Ayam Slice 500g',
            'category' => 'Frozen Food',
            'stock' => 5, // Low stock for alert demo
            'capital_price' => 25000,
            'selling_price' => 35000,
        ]);
    }
}
