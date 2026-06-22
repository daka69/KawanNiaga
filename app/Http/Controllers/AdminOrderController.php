<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,processing,shipped,completed,cancelled'
        ]);

        if ($request->status === 'cancelled' && $order->status !== 'cancelled') {
            DB::beginTransaction();
            try {
                // Kembalikan stok
                foreach ($order->items as $item) {
                    if ($item->product_id) {
                        $product = \App\Models\Product::lockForUpdate()->find($item->product_id);
                        if ($product) {
                            $product->increment('stock', $item->quantity);
                        }
                    }
                }
                $order->update(['status' => 'cancelled']);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Gagal membatalkan pesanan: ' . $e->getMessage());
            }
        } elseif ($request->status !== 'cancelled' && $order->status === 'cancelled') {
            DB::beginTransaction();
            try {
                // Potong stok kembali jika order dihidupkan lagi
                foreach ($order->items as $item) {
                    if ($item->product_id) {
                        $product = \App\Models\Product::lockForUpdate()->find($item->product_id);
                        if ($product) {
                            if ($product->stock < $item->quantity) {
                                DB::rollBack();
                                return redirect()->back()->with('error', 'Stok ' . $product->name . ' tidak mencukupi untuk memulihkan pesanan ini.');
                            }
                            $product->decrement('stock', $item->quantity);
                        }
                    }
                }
                $order->update(['status' => $request->status]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Gagal memulihkan pesanan: ' . $e->getMessage());
            }
        } else {
            $order->update([
                'status' => $request->status
            ]);
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
