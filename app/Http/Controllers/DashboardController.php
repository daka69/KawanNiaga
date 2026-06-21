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
            $data['totalProfitToday'] = Sale::whereDate('created_at', Carbon::today())->sum('total_profit');
            $data['totalSalesToday'] = Sale::whereDate('created_at', Carbon::today())->sum('total_price');
            $data['lowStockProducts'] = Product::where('stock', '<', 10)->get();
            $data['recentOrders'] = \App\Models\Order::with('user')->whereIn('status', ['pending', 'paid'])->latest()->take(5)->get();
            return view('admin.dashboard', $data);
        }

        return abort(403, 'Anda bukan penjual!');
    }
}
