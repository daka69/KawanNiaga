<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PromoCode;
use Illuminate\Support\Facades\DB;

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

        return redirect()->route('cart.index');
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

        return redirect()->route('cart.index');
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

        // Pastikan delivery fee tidak bisa dimanipulasi jadi minus
        $delivery = max(0, (int) $request->input('delivery', 25000));
        $promoDiscount = session('promo_discount', 0);
        
        // Pastikan total tidak bisa minus akibat diskon yang lebih besar dari subtotal
        $total = max(0, $subtotal + $delivery - $promoDiscount);

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
        // Pencegahan Double-Submit (Poin 5)
        if (!session()->has('pending_payment')) {
            return redirect()->route('store.index')->with('error', 'Sesi pembayaran kadaluarsa atau pesanan sudah dibuat.');
        }

        $cart = session()->get('cart');
        
        if (!$cart || count($cart) === 0) {
            return redirect()->route('store.index')->with('error', 'Keranjang Anda kosong!');
        }

        $pendingPayment = session('pending_payment', []);
        $orderNumber = 'KN-' . strtoupper(substr(md5(time() . rand()), 0, 8));

        DB::beginTransaction();
        try {
            $realSubtotal = 0;
            $orderItemsData = [];

            foreach ($cart as $id => $details) {
                // Gunakan lockForUpdate() agar mencegah 2 pembeli membeli stok terakhir bersamaan (Race Condition)
                $product = Product::lockForUpdate()->find($id);
                if (!$product) continue;

                $quantity = $details['quantity'];

                // Cek ulang stok dengan ketat
                if ($product->stock < $quantity) {
                    DB::rollBack();
                    return redirect()->route('cart.index')->with('error', 'Maaf, stok ' . $product->name . ' tidak mencukupi. Tersisa: ' . $product->stock);
                }

                // Kalkulasi harga AKURAT langsung dari Database (Poin 4)
                $total_price = $product->selling_price * $quantity;
                $total_profit = ($product->selling_price - $product->capital_price) * $quantity;
                $realSubtotal += $total_price;

                $orderItemsData[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $quantity,
                    'price' => $product->selling_price,
                    'capital_price' => $product->capital_price,
                    'subtotal' => $total_price,
                    'profit' => $total_profit,
                ];

                $product->decrement('stock', $quantity);
            }

            $deliveryFee = $pendingPayment['delivery'] ?? 0;
            $discount = $pendingPayment['discount'] ?? 0;
            $realTotal = max(0, $realSubtotal + $deliveryFee - $discount);

            // Buat Order di database dengan harga yang sudah dikalkulasi ulang
            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => auth()->id(),
                'shipping_address' => auth()->user()->address ?? '-',
                'payment_method' => $pendingPayment['method'] ?? 'va',
                'subtotal' => $realSubtotal,
                'delivery_fee' => $deliveryFee,
                'discount' => $discount,
                'total' => $realTotal,
                'status' => 'paid', // Status hardcode untuk demo (Poin 14)
            ]);

            // Simpan items setelah Order berhasil dibuat
            foreach ($orderItemsData as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'SYSTEM ERROR: ' . $e->getMessage() . ' di baris ' . $e->getLine());
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
        
        $promo = PromoCode::where('code', strtoupper($request->promo_code))
            ->where('is_active', true)
            ->where(function($q) {
                $q->whereNull('valid_until')->orWhere('valid_until', '>=', now());
            })->first();

        if ($promo) {
            $cart = session()->get('cart', []);
            $subtotal = 0;
            foreach ($cart as $details) {
                $subtotal += $details['price'] * $details['quantity'];
            }

            if ($subtotal < $promo->min_purchase) {
                return redirect()->back()->with('error', 'Minimal belanja untuk promo ini adalah Rp ' . number_format($promo->min_purchase, 0, ',', '.'));
            }

            session()->put('promo_discount', $promo->discount_amount);
            return redirect()->back()->with('success', 'Promo ' . $promo->code . ' berhasil diterapkan! Diskon Rp ' . number_format($promo->discount_amount, 0, ',', '.'));
        }

        return redirect()->back()->with('error', 'Kode promo tidak valid atau sudah kadaluarsa.');
    }
}
