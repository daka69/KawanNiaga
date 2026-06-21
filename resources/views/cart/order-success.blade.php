<x-storefront-layout>
<style>
    @keyframes checkmark {
        0% { transform: scale(0) rotate(-45deg); opacity: 0; }
        50% { transform: scale(1.2) rotate(-45deg); opacity: 1; }
        100% { transform: scale(1) rotate(-45deg); opacity: 1; }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse-ring {
        0% { transform: scale(0.9); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 0.2; }
        100% { transform: scale(0.9); opacity: 0.5; }
    }
    .success-checkmark { animation: checkmark 0.6s ease-out 0.3s both; }
    .fade-in-up { animation: fadeInUp 0.6s ease-out both; }
    .fade-in-up-1 { animation-delay: 0.4s; }
    .fade-in-up-2 { animation-delay: 0.6s; }
    .fade-in-up-3 { animation-delay: 0.8s; }
    .fade-in-up-4 { animation-delay: 1.0s; }
    .pulse-ring { animation: pulse-ring 2s ease-in-out infinite; }
</style>

<main class="max-w-[700px] mx-auto px-6 md:px-12 pt-[140px] md:pt-[160px] pb-12">
    <div class="outer-shell">
        <div class="inner-core bg-white p-8 md:p-12 relative overflow-hidden text-center">
            <div class="absolute top-0 left-0 w-64 h-64 bg-[#121212]/5 rounded-full blur-3xl pointer-events-none transform -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-48 h-48 bg-[#121212]/5 rounded-full blur-3xl pointer-events-none transform translate-x-1/3 translate-y-1/3"></div>

            <div class="relative z-10 flex flex-col items-center">
                <!-- Animated Success Icon -->
                <div class="relative mb-8">
                    <div class="w-28 h-28 bg-[#fcfcfc] rounded-full flex items-center justify-center pulse-ring border border-[#121212]/10">
                        <div class="w-20 h-20 bg-[#121212] rounded-full flex items-center justify-center shadow-sm">
                            <i class="ph text-white text-[48px] success-checkmark ph-check-circle" style="font-variation-settings: 'FILL' 1;"></i>
                        </div>
                    </div>
                </div>

                <h1 class="text-4xl md:text-5xl font-display font-semibold text-[#121212] mb-3 tracking-tight-display fade-in-up fade-in-up-1">Pesanan Berhasil!</h1>
                <p class="font-jakarta text-[#121212]/60 text-lg mb-8 fade-in-up fade-in-up-1">Terima kasih telah berbelanja di KawanNiaga.</p>

                <!-- Order Number -->
                <div class="bg-[#fcfcfc] rounded-2xl px-8 py-5 mb-8 border border-[#121212]/10 fade-in-up fade-in-up-2 inline-block">
                    <p class="text-sm font-semibold text-[#121212]/60 uppercase tracking-widest mb-1">Nomor Pesanan</p>
                    <p class="font-display font-semibold text-[#121212] text-3xl tracking-widest">{{ $order->order_number }}</p>
                </div>

                <!-- Order Summary -->
                <div class="w-full bg-white rounded-2xl p-8 mb-8 text-left border border-[#121212]/10 fade-in-up fade-in-up-3 shadow-sm">
                    <h3 class="font-display font-semibold text-2xl text-[#121212] mb-6 flex items-center gap-3 tracking-tight-display">
                        <i class="ph ph-receipt text-2xl text-[#121212]/60"></i> Ringkasan Pesanan
                    </h3>
                    <div class="flex flex-col gap-4 font-jakarta">
                        @foreach($order->items as $item)
                        <div class="flex justify-between items-center pb-4 border-b border-[#121212]/5 last:border-0 last:pb-0">
                            <div>
                                <p class="font-semibold text-[#121212] text-lg">{{ $item->product_name }}</p>
                                <p class="text-sm text-[#121212]/60">{{ $item->quantity }} barang x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <span class="font-semibold text-[#121212] text-lg">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-[#121212]/10">
                        <div class="flex justify-between items-center mb-3">
                            <span class="font-jakarta font-semibold text-[#121212]/60 text-sm uppercase tracking-widest">Total Dibayar</span>
                            <span class="font-display font-semibold text-[#121212] text-2xl tracking-tight-display">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-end gap-2 text-sm font-jakarta font-semibold text-[#121212]/70 uppercase tracking-widest">
                            <span>{{ $order->payment_method == 'ewallet' ? 'E-Wallet (QRIS)' : ($order->payment_method == 'cc' ? 'Kartu Kredit / Debit' : 'Virtual Account') }}</span>
                            <i class="ph text-lg {{ $order->payment_method == 'ewallet' ? 'ph-qr-code' : ($order->payment_method == 'cc' ? 'ph-credit-card' : 'ph-bank') }}"></i>
                        </div>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="w-full bg-[#fcfcfc] border border-[#121212]/10 rounded-2xl p-5 mb-10 text-left flex items-start gap-4 fade-in-up fade-in-up-3">
                    <i class="ph ph-info text-2xl text-[#121212]/60 flex-shrink-0 mt-0.5"></i>
                    <p class="text-sm font-jakarta text-[#121212]/70 leading-relaxed">Pesanan Anda sedang diproses dan akan segera dikirim. Anda dapat melihat status pesanan di halaman <strong>Pesanan Saya</strong>.</p>
                </div>

                <!-- CTA -->
                <div class="flex flex-col sm:flex-row gap-4 w-full fade-in-up fade-in-up-4">
                    <a href="{{ route('orders.index') }}" class="flex-1 bg-[#fcfcfc] border border-[#121212]/10 text-[#121212] hover:bg-[#121212]/5 font-jakarta font-semibold text-lg py-4 rounded-full transition-colors active:scale-95 flex items-center justify-center gap-2">
                        <i class="ph ph-receipt"></i> Lihat Pesanan
                    </a>
                    <a href="{{ route('store.index') }}" class="flex-1 bg-[#121212] hover:bg-black text-white font-jakarta font-semibold text-lg py-4 rounded-full shadow-sm transition-colors active:scale-95 flex items-center justify-center gap-2">
                        <i class="ph ph-storefront"></i> Kembali Belanja
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
</x-storefront-layout>
