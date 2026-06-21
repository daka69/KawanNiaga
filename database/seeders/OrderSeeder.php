<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'asd@gmail.com')->first();
        if (!$user) return;

        $product = Product::first();
        if (!$product) return;

        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'user_id' => $user->id,
            'total' => $product->selling_price,
            'subtotal' => $product->selling_price,
            'delivery_fee' => 0,
            'discount' => 0,
            'status' => 'pending',
            'shipping_address' => 'Jl. Test Address No. 123',
            'payment_method' => 'va',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'price' => $product->selling_price,
            'quantity' => 1,
            'subtotal' => $product->selling_price,
        ]);
    }
}
