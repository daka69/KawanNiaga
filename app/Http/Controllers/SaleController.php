<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;

class SaleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        // Calculate totals
        $total_price = $product->selling_price * $request->quantity;
        $profit_per_item = $product->selling_price - $product->capital_price;
        $total_profit = $profit_per_item * $request->quantity;

        // Record Sale
        Sale::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'quantity' => $request->quantity,
            'total_price' => $total_price,
            'total_profit' => $total_profit,
        ]);

        // Reduce Stock
        $product->decrement('stock', $request->quantity);

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil disimpan!');
    }
}
