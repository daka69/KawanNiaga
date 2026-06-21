<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $newQuantity = $cart[$product->id]['quantity'] + $request->quantity;
            if ($newQuantity > $product->stock) {
                return redirect()->back()->with('error', 'Gagal: Stok tersisa hanya ' . $product->stock);
            }
            $cart[$product->id]['quantity'] = $newQuantity;
        } else {
            if ($request->quantity > $product->stock) {
                return redirect()->back()->with('error', 'Gagal: Stok tersisa hanya ' . $product->stock);
            }
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $product->selling_price,
                'category' => $product->category,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Berhasil menambahkan ' . $product->name . ' ke keranjang!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $product = Product::findOrFail($request->id);

            if ($request->quantity > $product->stock) {
                return redirect()->back()->with('error', 'Stok ' . $product->name . ' tersisa ' . $product->stock);
            }

            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Keranjang diperbarui!');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
        }
    }

    public function checkout()
    {
        $cart = session()->get('cart');
        
        if (!$cart || count($cart) === 0) {
            return redirect()->route('store.index')->with('error', 'Keranjang Anda kosong!');
        }

        return view('cart.checkout');
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart');
        
        if (!$cart || count($cart) === 0) {
            return redirect()->route('store.index')->with('error', 'Keranjang Anda kosong!');
        }

        // Validasi alamat
        if (!auth()->user()->address) {
            return redirect()->route('checkout.index')->with('error', 'Anda harus mengisi alamat pengiriman terlebih dahulu sebelum melanjutkan pembayaran.');
        }

        $subtotal = 0;
        foreach ($cart as $id => $details) {
            $subtotal += $details['price'] * $details['quantity'];
        }

        $delivery = $request->input('delivery', 25000);
        $promoDiscount = session('promo_discount', 0);
        $total = $subtotal + $delivery - $promoDiscount;

        // Generate VA number sekali dan simpan di session
        $vaNumber = '8077 ' . rand(1000, 9999) . ' ' . rand(1000, 9999) . ' ' . rand(10, 99);

        session()->put('pending_payment', [
            'method' => $request->input('payment', 'va'),
            'delivery' => $delivery,
            'subtotal' => $subtotal,
            'discount' => $promoDiscount,
            'total' => $total,
            'va_number' => $vaNumber,
        ]);

        return redirect()->route('payment.index');
    }

    public function payment()
    {
        if (!session()->has('pending_payment') || !session()->has('cart')) {
            return redirect()->route('store.index');
        }

        return view('cart.payment');
    }

    public function confirmPayment()
    {
        $cart = session()->get('cart');
        
        if (!$cart || count($cart) === 0) {
            return redirect()->route('store.index')->with('error', 'Keranjang Anda kosong!');
        }

        $pendingPayment = session('pending_payment', []);
        $orderNumber = 'KN-' . strtoupper(substr(md5(time() . rand()), 0, 8));

        // Buat Order di database
        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => auth()->id(),
            'shipping_address' => auth()->user()->address ?? '-',
            'payment_method' => $pendingPayment['method'] ?? 'va',
            'subtotal' => $pendingPayment['subtotal'] ?? 0,
            'delivery_fee' => $pendingPayment['delivery'] ?? 0,
            'discount' => $pendingPayment['discount'] ?? 0,
            'total' => $pendingPayment['total'] ?? 0,
            'status' => 'paid',
        ]);

        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if (!$product) continue;

            $quantity = $details['quantity'];

            // Cek ulang stok
            if ($product->stock < $quantity) {
                $order->delete();
                return redirect()->route('cart.index')->with('error', 'Maaf, stok ' . $product->name . ' tidak mencukupi.');
            }

            $total_price = $product->selling_price * $quantity;
            $total_profit = ($product->selling_price - $product->capital_price) * $quantity;

            // Simpan ke sales (untuk laporan penjual)
            Sale::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'quantity' => $quantity,
                'total_price' => $total_price,
                'total_profit' => $total_profit,
            ]);

            // Simpan ke order_items (untuk riwayat pembeli)
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->selling_price,
                'subtotal' => $total_price,
            ]);

            $product->decrement('stock', $quantity);
        }

        session()->forget('cart');
        session()->forget('pending_payment');
        session()->forget('promo_discount');

        return redirect()->route('order.success', ['order' => $order->id]);
    }

    public function orderSuccess(Order $order)
    {
        // Pastikan hanya pemilik pesanan yang bisa lihat
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('store.index');
        }

        $order->load('items');
        return view('cart.order-success', compact('order'));
    }

    public function applyPromo(Request $request)
    {
        $request->validate(['promo_code' => 'required|string']);
        if (strtoupper($request->promo_code) == 'CERIA25') {
            session()->put('promo_discount', 25000);
            return redirect()->back()->with('success', 'Promo CERIA25 berhasil diterapkan! Diskon Rp 25.000.');
        }
        return redirect()->back()->with('error', 'Kode promo tidak valid atau sudah kadaluarsa.');
    }
}
