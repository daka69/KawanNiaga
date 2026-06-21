<x-storefront-layout>
<main class="flex-grow w-full max-w-[1400px] mx-auto px-6 md:px-12 pt-[140px] md:pt-[160px] pb-12">
    <h1 class="text-4xl md:text-5xl font-display font-semibold text-[#121212] mb-8 tracking-tight-display">Pesanan Saya</h1>

    @if($orders->isEmpty())
    <div class="outer-shell">
        <div class="inner-core bg-white p-16 text-center flex flex-col items-center justify-center min-h-[400px]">
            <div class="w-24 h-24 bg-[#121212]/5 rounded-full flex items-center justify-center mb-6">
                <i class="ph ph-receipt text-5xl text-[#121212]/40"></i>
            </div>
            <h3 class="text-3xl font-display font-semibold text-[#121212] mb-3 tracking-tight-display">Belum Ada Pesanan</h3>
            <p class="text-[#121212]/60 font-jakarta max-w-md text-lg mb-8">Anda belum pernah melakukan pembelian. Yuk mulai belanja!</p>
            <a href="{{ route('store.index') }}" class="bg-[#121212] hover:bg-black text-white px-8 py-4 rounded-full font-jakarta font-semibold shadow-sm transition-colors active:scale-95 flex items-center justify-center gap-2">
                <i class="ph ph-storefront text-xl"></i> Mulai Belanja
            </a>
        </div>
    </div>
    @else
    <div class="flex flex-col gap-8">
        @foreach($orders as $order)
        <div class="outer-shell group hover:-translate-y-1 motion-fluid shadow-sm hover:shadow-ambient">
            <div class="inner-core bg-white p-0 relative overflow-hidden flex flex-col h-full">
                <!-- Order Header -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between p-6 bg-[#fcfcfc] border-b border-[#121212]/5">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-[#121212]/5 flex items-center justify-center flex-shrink-0 text-[#121212]">
                            <i class="ph ph-receipt text-xl"></i>
                        </div>
                        <div>
                            <p class="font-display font-semibold text-[#121212] text-xl">{{ $order->order_number }}</p>
                            <p class="text-sm font-jakarta text-[#121212]/60">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        @php
                            $statusMap = [
                                'pending' => ['Menunggu', 'bg-yellow-50 text-yellow-700 border-yellow-200'],
                                'paid' => ['Dibayar', 'bg-blue-50 text-blue-700 border-blue-200'],
                                'processing' => ['Diproses', 'bg-[#121212] text-white border-[#121212]'],
                                'shipped' => ['Dikirim', 'bg-purple-50 text-purple-700 border-purple-200'],
                                'completed' => ['Selesai', 'bg-green-50 text-green-700 border-green-200'],
                                'cancelled' => ['Dibatalkan', 'bg-red-50 text-red-700 border-red-200'],
                            ];
                            $status = $statusMap[$order->status] ?? ['Unknown', 'bg-gray-50 text-gray-700 border-gray-200'];
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full font-jakarta font-semibold text-xs border uppercase tracking-widest {{ $status[1] }}">
                            @if($order->status !== 'processing')
                                <span class="w-2 h-2 rounded-full bg-current"></span>
                            @endif
                            {{ $status[0] }}
                        </span>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="p-6 md:p-8 flex flex-col flex-grow">
                    <div class="flex flex-col gap-4 mb-6">
                        @foreach($order->items as $item)
                        <div class="flex justify-between items-center font-jakarta">
                            <div>
                                <p class="font-semibold text-[#121212]">{{ $item->product_name }}</p>
                                <p class="text-sm text-[#121212]/60">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <span class="font-semibold text-[#121212]">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>

                    <div class="h-px w-full bg-[#121212]/5 my-2"></div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mt-4">
                        <div class="flex flex-wrap items-center gap-4 text-sm font-jakarta text-[#121212]/60">
                            <span class="flex items-center gap-1.5">
                                <i class="ph ph-credit-card text-lg"></i>
                                {{ $order->payment_method == 'ewallet' ? 'QRIS' : ($order->payment_method == 'cc' ? 'Kartu' : 'VA') }}
                            </span>
                            <span class="flex items-center gap-1.5">
                                <i class="ph ph-truck text-lg"></i>
                                Rp {{ number_format($order->delivery_fee, 0, ',', '.') }}
                            </span>
                            @if($order->discount > 0)
                            <span class="flex items-center gap-1.5 text-green-600">
                                <i class="ph ph-tag text-lg"></i>
                                -Rp {{ number_format($order->discount, 0, ',', '.') }}
                            </span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto">
                            <div class="text-left sm:text-right">
                                <span class="text-sm font-jakarta text-[#121212]/60 block mb-1">Total Belanja</span>
                                <span class="font-display font-semibold text-[#121212] text-2xl tracking-tight-display">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center justify-center gap-2 bg-[#121212]/5 text-[#121212] hover:bg-[#121212] hover:text-white w-12 h-12 rounded-full transition-colors active:scale-95">
                                <i class="ph ph-arrow-right text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</main>
</x-storefront-layout>
