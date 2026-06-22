<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return redirect()->route('store.index');
});

// SECRET ROUTE UNTUK SETUP DATABASE DI RAILWAY
Route::get('/deploy-setup', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        return "SUKSES! Database telah dimigrasi dan di-seed. Akun penjual: penjual@kawanniaga.test (password: password)";
    } catch (\Exception $e) {
        return "ERROR: " . $e->getMessage();
    }
});

// Katalog Publik
Route::get('/store', [\App\Http\Controllers\StoreController::class, 'index'])->name('store.index');
Route::get('/store/catalog', [\App\Http\Controllers\StoreController::class, 'catalog'])->name('store.catalog');
Route::get('/store/{product}', [\App\Http\Controllers\StoreController::class, 'show'])->name('store.show');
Route::get('/about', [\App\Http\Controllers\StoreController::class, 'about'])->name('about');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('role:penjual');

    // Penjual Routes
    Route::middleware('role:penjual')->group(function () {
        Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');
        Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');
        Route::resource('products', ProductController::class);

        // Manajemen Pesanan
        Route::get('/admin/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/admin/orders/{order}', [\App\Http\Controllers\AdminOrderController::class, 'show'])->name('admin.orders.show');
        Route::patch('/admin/orders/{order}/status', [\App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('admin.orders.update-status');
    });

    // Pembeli Routes (Keranjang & Transaksi)
    Route::middleware('role:pembeli')->group(function () {
        Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
        Route::post('/cart/update', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
        Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
        
        Route::get('/checkout', [\App\Http\Controllers\CartController::class, 'checkout'])->name('checkout.index');
        Route::post('/checkout/process', [\App\Http\Controllers\CartController::class, 'process'])->name('checkout.process');
        Route::post('/checkout/promo', [\App\Http\Controllers\CartController::class, 'applyPromo'])->name('checkout.promo');
        
        Route::get('/payment', [\App\Http\Controllers\CartController::class, 'payment'])->name('payment.index');
        Route::post('/payment/confirm', [\App\Http\Controllers\CartController::class, 'confirmPayment'])->name('payment.confirm');
        Route::get('/order-success/{order}', [\App\Http\Controllers\CartController::class, 'orderSuccess'])->name('order.success');

        // Pesanan Saya
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
