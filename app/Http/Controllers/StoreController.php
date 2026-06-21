<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
        // Beranda hanya menampilkan 4 produk pilihan (misalnya yang terbaru/terlaris)
        $featuredProducts = Product::where('stock', '>', 0)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('store.index', compact('featuredProducts'));
    }

    public function catalog(Request $request)
    {
        $query = Product::where('stock', '>', 0);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Ambil daftar kategori untuk sidebar
        $categories = Product::where('stock', '>', 0)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        $products = $query->paginate(12);

        return view('store.catalog', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        if ($product->stock <= 0) {
            return redirect()->route('store.index')->with('error', 'Produk tidak tersedia.');
        }

        // Ambil produk acak untuk rekomendasi Pasangan Sempurna
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->inRandomOrder()
            ->limit(6)
            ->get();

        return view('store.show', compact('product', 'relatedProducts'));
    }

    public function about()
    {
        return view('store.about');
    }
}
