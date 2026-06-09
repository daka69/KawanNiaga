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

        if ($role === 'admin') {
            $data['productsCount'] = Product::count();
            $data['totalProfitToday'] = Sale::whereDate('created_at', Carbon::today())->sum('total_profit');
            $data['totalSalesToday'] = Sale::whereDate('created_at', Carbon::today())->sum('total_price');
            $data['lowStockProducts'] = Product::where('stock', '<', 10)->get();
            return view('admin.dashboard', $data);
        } elseif ($role === 'kasir') {
            $data['products'] = Product::where('stock', '>', 0)->get();
            return view('kasir.dashboard', $data);
        } elseif ($role === 'gudang') {
            $data['products'] = Product::all();
            return view('gudang.dashboard', $data);
        }

        return abort(403);
    }
}
