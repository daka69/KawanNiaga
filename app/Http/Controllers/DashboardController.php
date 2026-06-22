<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->user()->role;
        $data = [];

        if ($role === 'penjual') {
            $data['productsCount'] = Product::count();
            
            // Mengambil profit dari order_items yang berelasi dengan order yang sudah dibayar hari ini
            $data['totalProfitToday'] = \App\Models\OrderItem::whereHas('order', function($q) {
                $q->whereIn('status', ['paid', 'processing', 'shipped', 'completed'])
                  ->whereDate('created_at', Carbon::today());
            })->sum('profit');

            // Total sales didapatkan langsung dari Order yang sudah dibayar hari ini
            $data['totalSalesToday'] = \App\Models\Order::whereIn('status', ['paid', 'processing', 'shipped', 'completed'])
                ->whereDate('created_at', Carbon::today())
                ->sum('total');
            $data['lowStockProducts'] = Product::where('stock', '<', 10)->get();
            $data['recentOrders'] = \App\Models\Order::with('user')->whereIn('status', ['pending', 'paid'])->latest()->take(5)->get();
            return view('admin.dashboard', $data);
        }

        return abort(403, 'Anda bukan penjual!');
    }
}
