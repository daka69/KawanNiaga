<x-storefront-layout>
<main class="flex-grow w-full max-w-[1400px] mx-auto px-6 md:px-12 pt-[140px] md:pt-[160px] pb-12">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm font-jakarta text-[#121212]/60 mb-6 overflow-x-auto whitespace-nowrap scrollbar-hide">
        <a class="hover:text-[#121212] transition-colors" href="{{ route('store.index') }}">Beranda</a>
        <i class="ph ph-caret-right text-xs"></i>
        <a class="hover:text-[#121212] transition-colors" href="{{ route('orders.index') }}">Pesanan Saya</a>
        <i class="ph ph-caret-right text-xs"></i>
        <span class="text-[#121212] font-semibold">{{ $order->order_number }}</span>
    </div>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <h1 class="text-4xl md:text-5xl font-display font-semibold text-[#121212] tracking-tight-display">Detail Pesanan</h1>
        <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center bg-[#121212]/5 hover:bg-[#121212]/10 text-[#121212] px-6 py-3 rounded-full font-jakarta font-semibold transition-colors w-full md:w-auto">
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Kiri: Detail Order -->
        <div class="lg:col-span-8 flex flex-col gap-8">
            <!-- Header Info -->
            <div class="outer-shell">
                <div class="inner-core bg-white p-6 md:p-8 flex flex-col md:flex-row justify-between md:items-center gap-6">
                    <div>
                        <p class="text-sm font-jakarta text-[#121212]/60 mb-1">Nomor Pesanan</p>
                        <p class="font-display font-semibold text-[#121212] text-2xl tracking-widest">{{ $order->order_number }}</p>
                        <p class="text-sm font-jakarta text-[#121212]/60 mt-2">Tanggal: {{ $order->created_at->format('d F Y, H:i') }} WIB</p>
                    </div>
                    <div>
                        @php
                            $statusMap = [
                                'pending' => ['Menunggu Pembayaran', 'bg-yellow-50 text-yellow-700 border-yellow-200'],
                                'paid' => ['Sudah Dibayar', 'bg-blue-50 text-blue-700 border-blue-200'],
                                'processing' => ['Sedang Diproses', 'bg-[#121212] text-white border-[#121212]'],
                                'shipped' => ['Dalam Pengiriman', 'bg-purple-50 text-purple-700 border-purple-200'],
                                'completed' => ['Selesai', 'bg-green-50 text-green-700 border-green-200'],
                                'cancelled' => ['Dibatalkan', 'bg-red-50 text-red-700 border-red-200'],
                            ];
                            $status = $statusMap[$order->status] ?? ['Unknown', 'bg-gray-50 text-gray-700 border-gray-200'];
                        @endphp
                        <span class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full font-jakarta font-semibold border {{ $status[1] }}">
                            @if($order->status !== 'processing')
                                <span class="w-2.5 h-2.5 rounded-full bg-current"></span>
                            @endif
                            {{ $status[0] }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Alamat Kirim -->
            <div class="outer-shell relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-[#121212]/5 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
                <div class="inner-core bg-white p-6 md:p-8 relative z-10">
                    <div class="flex items-center gap-3 text-[#121212] mb-6">
                        <i class="ph ph-map-pin text-2xl text-[#121212]/60"></i>
                        <h2 class="text-2xl font-display font-semibold tracking-tight-display">Alamat Pengiriman</h2>
                    </div>
                    <div class="bg-[#fcfcfc] border border-[#121212]/5 p-6 rounded-2xl">
                        <p class="font-jakarta font-semibold text-[#121212] mb-2">{{ $order->user->name }} <span class="text-[#121212]/40 font-normal mx-2">|</span> {{ $order->user->phone ?? '-' }}</p>
                        <p class="font-jakarta text-[#121212]/70 leading-relaxed">{{ $order->shipping_address }}</p>
                    </div>
                </div>
            </div>

            <!-- Item Pesanan -->
            <div class="outer-shell">
                <div class="inner-core bg-white p-6 md:p-8">
                    <div class="flex items-center gap-3 text-[#121212] mb-8">
                        <i class="ph ph-bag-simple text-2xl text-[#121212]/60"></i>
                        <h2 class="text-2xl font-display font-semibold tracking-tight-display">Daftar Produk</h2>
                    </div>
                    
                    <div class="flex flex-col gap-6">
                        @foreach($order->items as $item)
                            <div class="flex flex-col sm:flex-row gap-6 items-start sm:items-center pb-6 border-b border-[#121212]/5 last:border-0 last:pb-0">
                                <!-- Image fallback logic -->
                                <div class="w-24 h-24 rounded-2xl bg-[#fcfcfc] flex-shrink-0 overflow-hidden relative flex items-center justify-center border border-[#121212]/10 shadow-sm">
                                    @if($item->product && $item->product->image)
                                        <img class="w-[120%] h-[120%] object-cover object-center absolute" src="{{ str_starts_with($item->product->image, 'http') ? $item->product->image : asset($item->product->image) }}?v={{ time() }}" alt="{{ $item->product_name }}">
                                    @else
                                        <i class="ph ph-package text-4xl text-[#121212]/20"></i>
                                    @endif
                                </div>
                                
                                <div class="flex-grow w-full font-jakarta">
                                    <p class="font-semibold text-[#121212] text-xl mb-2">{{ $item->product_name }}</p>
                                    <p class="text-[#121212]/60 text-sm">{{ $item->quantity }} barang x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                
                                <div class="text-left sm:text-right w-full sm:w-auto font-jakarta pt-2 sm:pt-0 border-t border-[#121212]/5 sm:border-0">
                                    <p class="text-sm text-[#121212]/60 mb-1">Subtotal Harga</p>
                                    <p class="font-semibold text-[#121212] text-xl">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Kanan: Ringkasan Biaya -->
        <div class="lg:col-span-4">
            <div class="outer-shell sticky top-[100px]">
                <div class="inner-core bg-white p-8">
                    <h2 class="font-display font-semibold text-2xl text-[#121212] border-b border-[#121212]/10 pb-6 mb-6 tracking-tight-display">Rincian Pembayaran</h2>
                    
                    <div class="flex flex-col gap-4 mb-8 font-jakarta">
                        <div class="flex justify-between text-[#121212]/70 text-sm">
                            <span>Total Harga Barang</span>
                            <span class="font-medium text-[#121212]">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-[#121212]/70 text-sm">
                            <span>Ongkos Kirim</span>
                            <span class="font-medium text-[#121212]">Rp {{ number_format($order->delivery_fee, 0, ',', '.') }}</span>
                        </div>
                        @if($order->discount > 0)
                        <div class="flex justify-between text-green-600 text-sm">
                            <span>Diskon Promo</span>
                            <span class="font-semibold">- Rp {{ number_format($order->discount, 0, ',', '.') }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="border-t border-[#121212]/10 pt-6 mb-8">
                        <div class="flex justify-between items-center">
                            <span class="font-jakarta font-semibold text-[#121212]">Total Belanja</span>
                            <span class="font-display font-semibold text-3xl text-[#121212] tracking-tight-display">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="bg-[#fcfcfc] border border-[#121212]/10 rounded-2xl p-5 flex items-center gap-4 mb-2">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-[#121212] shadow-sm border border-[#121212]/5 flex-shrink-0">
                            <i class="ph text-2xl {{ $order->payment_method == 'ewallet' ? 'ph-qr-code' : ($order->payment_method == 'cc' ? 'ph-credit-card' : 'ph-bank') }}"></i>
                        </div>
                        <div class="font-jakarta">
                            <p class="text-xs text-[#121212]/50 mb-1 font-semibold uppercase tracking-widest">Metode Pembayaran</p>
                            <p class="font-semibold text-[#121212]">
                                {{ $order->payment_method == 'ewallet' ? 'QRIS / E-Wallet' : ($order->payment_method == 'cc' ? 'Kartu Kredit / Debit' : 'Virtual Account') }}
                            </p>
                        </div>
                    </div>

                    @if($order->status === 'pending')
                        <a href="{{ route('payment.checkout') }}" class="mt-8 w-full bg-[#121212] hover:bg-black text-white font-jakarta font-semibold py-4 rounded-full shadow-sm transition-colors active:scale-95 flex items-center justify-center gap-2 text-center">
                            <i class="ph ph-wallet text-xl"></i> Bayar Sekarang
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
</x-storefront-layout>
