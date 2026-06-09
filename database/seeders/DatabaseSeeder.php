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
        // Create Admin
        User::factory()->create([
            'name' => 'Admin Pemilik',
            'email' => 'admin@kawanniaga.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Kasir
        User::factory()->create([
            'name' => 'Kasir Toko',
            'email' => 'kasir@kawanniaga.test',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);

        // Create Gudang
        User::factory()->create([
            'name' => 'Staff Gudang',
            'email' => 'gudang@kawanniaga.test',
            'password' => Hash::make('password'),
            'role' => 'gudang',
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
