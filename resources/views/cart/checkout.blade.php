<x-storefront-layout>
    <main class="flex-grow w-full max-w-[1400px] mx-auto px-6 md:px-12 pt-[140px] md:pt-[160px] pb-24">
        <h1 class="text-4xl md:text-5xl font-display font-semibold text-[#121212] mb-12 tracking-tight-display">Checkout</h1>
        
        @if(session('error'))
            <div class="outer-shell mb-8 motion-fluid">
                <div class="inner-core bg-[#121212] text-white p-4 flex items-center gap-3">
                    <i class="ph ph-warning-circle text-xl text-red-400"></i>
                    <span class="font-jakarta font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif
        @if(session('success'))
            <div class="outer-shell mb-8 motion-fluid">
                <div class="inner-core bg-[#121212] text-white p-4 flex items-center gap-3">
                    <i class="ph ph-check-circle text-xl text-green-400"></i>
                    <span class="font-jakarta font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Column: Forms -->
            <div class="lg:col-span-7 xl:col-span-8 flex flex-col gap-8">
                <!-- Shipping Address -->
                <section class="outer-shell">
                    <div class="inner-core bg-white p-8 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-[#121212]/5 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
                        <div class="flex justify-between items-start mb-6 relative z-10">
                            <div class="flex items-center gap-3 text-[#121212]">
                                <i class="ph ph-map-pin text-2xl text-[#121212]/60"></i>
                                <h2 class="text-xl font-jakarta font-semibold">Alamat Pengiriman</h2>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="bg-[#121212]/5 text-[#121212] hover:bg-[#121212]/10 px-5 py-2.5 rounded-full font-jakarta font-semibold transition-colors text-sm">
                                Ubah Alamat
                            </a>
                        </div>
                        <div class="relative z-10 bg-[#fcfcfc] p-5 rounded-2xl border border-[#121212]/10">
                            @if(auth()->user()->address)
                                <p class="font-jakarta font-semibold text-[#121212] mb-1 text-lg">{{ auth()->user()->name }} <span class="text-[#121212]/40 font-normal text-base ml-2">| {{ auth()->user()->phone ?? 'Belum ada nomor telepon' }}</span></p>
                                <p class="text-[#121212]/70 font-jakarta leading-relaxed">{{ auth()->user()->address }}</p>
                            @else
                                <div class="text-red-600 flex items-center gap-2 mb-2 font-jakarta">
                                    <i class="ph ph-warning"></i>
                                    <p class="font-semibold">Alamat pengiriman belum diisi!</p>
                                </div>
                                <p class="text-[#121212]/60 text-sm font-jakarta">Pesanan Anda tidak dapat dikirim tanpa alamat. Silakan klik tombol "Ubah Alamat" di atas untuk melengkapi profil Anda.</p>
                            @endif
                        </div>
                    </div>
                </section>
                
                <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <!-- Delivery Options -->
                    <section class="outer-shell mb-8">
                        <div class="inner-core bg-white p-8 relative overflow-hidden">
                            <div class="absolute bottom-0 left-0 w-40 h-40 bg-[#121212]/5 rounded-full blur-3xl -ml-20 -mb-20 pointer-events-none"></div>
                            <div class="flex items-center gap-3 text-[#121212] mb-6 relative z-10">
                                <i class="ph ph-truck text-2xl text-[#121212]/60"></i>
                                <h2 class="text-xl font-jakarta font-semibold">Opsi Pengiriman</h2>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 relative z-10">
                                <label class="cursor-pointer relative group">
                                    <input checked class="sr-only peer" name="delivery" type="radio" value="25000" x-on:change="$dispatch('update-delivery', 25000)">
                                    <div class="h-full border border-[#121212]/10 peer-checked:border-[#121212] peer-checked:bg-[#121212]/5 bg-[#fcfcfc] rounded-2xl p-5 transition-all group-hover:border-[#121212]/30 flex flex-col items-center text-center gap-3">
                                        <i class="ph ph-lightning text-3xl text-[#121212]/40 peer-checked:text-[#121212]"></i>
                                        <span class="font-jakarta font-semibold text-[#121212]">Instant 3 Jam</span>
                                        <span class="text-[#121212] font-semibold mt-auto bg-white px-3 py-1 rounded-full border border-[#121212]/5 text-sm">Rp 25.000</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer relative group">
                                    <input class="sr-only peer" name="delivery" type="radio" value="15000" x-on:change="$dispatch('update-delivery', 15000)">
                                    <div class="h-full border border-[#121212]/10 peer-checked:border-[#121212] peer-checked:bg-[#121212]/5 bg-[#fcfcfc] rounded-2xl p-5 transition-all group-hover:border-[#121212]/30 flex flex-col items-center text-center gap-3">
                                        <i class="ph ph-clock text-3xl text-[#121212]/40 peer-checked:text-[#121212]"></i>
                                        <span class="font-jakarta font-semibold text-[#121212]">Same Day</span>
                                        <span class="text-[#121212] font-semibold mt-auto bg-white px-3 py-1 rounded-full border border-[#121212]/5 text-sm">Rp 15.000</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer relative group">
                                    <input class="sr-only peer" name="delivery" type="radio" value="10000" x-on:change="$dispatch('update-delivery', 10000)">
                                    <div class="h-full border border-[#121212]/10 peer-checked:border-[#121212] peer-checked:bg-[#121212]/5 bg-[#fcfcfc] rounded-2xl p-5 transition-all group-hover:border-[#121212]/30 flex flex-col items-center text-center gap-3">
                                        <i class="ph ph-car-profile text-3xl text-[#121212]/40 peer-checked:text-[#121212]"></i>
                                        <span class="font-jakarta font-semibold text-[#121212]">Reguler (1-2 Hari)</span>
                                        <span class="text-[#121212] font-semibold mt-auto bg-white px-3 py-1 rounded-full border border-[#121212]/5 text-sm">Rp 10.000</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </section>
                    
                    <!-- Payment Method -->
                    <section class="outer-shell">
                        <div class="inner-core bg-white p-8 relative overflow-hidden">
                            <div class="absolute top-1/2 right-1/4 w-48 h-48 bg-[#121212]/5 rounded-full blur-3xl pointer-events-none transform -translate-y-1/2"></div>
                            <div class="flex items-center gap-3 text-[#121212] mb-6 relative z-10">
                                <i class="ph ph-credit-card text-2xl text-[#121212]/60"></i>
                                <h2 class="text-xl font-jakarta font-semibold">Metode Pembayaran</h2>
                            </div>
                            <div class="flex flex-col gap-4 relative z-10">
                                <label class="cursor-pointer group">
                                    <input checked class="sr-only peer" name="payment" type="radio" value="va">
                                    <div class="flex items-center justify-between border border-[#121212]/10 peer-checked:border-[#121212] peer-checked:bg-[#121212]/5 bg-[#fcfcfc] rounded-2xl p-5 transition-all group-hover:border-[#121212]/30">
                                        <div class="flex items-center gap-5">
                                            <div class="w-12 h-12 bg-white border border-[#121212]/5 flex items-center justify-center rounded-full text-[#121212]">
                                                <i class="ph ph-bank text-xl"></i>
                                            </div>
                                            <span class="font-jakarta font-semibold text-[#121212] text-lg">Virtual Account (BCA, Mandiri, dll)</span>
                                        </div>
                                        <i class="ph-fill ph-check-circle text-[#121212]/20 peer-checked:text-[#121212] text-2xl"></i>
                                    </div>
                                </label>
                                <label class="cursor-pointer group">
                                    <input class="sr-only peer" name="payment" type="radio" value="ewallet">
                                    <div class="flex items-center justify-between border border-[#121212]/10 peer-checked:border-[#121212] peer-checked:bg-[#121212]/5 bg-[#fcfcfc] rounded-2xl p-5 transition-all group-hover:border-[#121212]/30">
                                        <div class="flex items-center gap-5">
                                            <div class="w-12 h-12 bg-white border border-[#121212]/5 flex items-center justify-center rounded-full text-[#121212]">
                                                <i class="ph ph-wallet text-xl"></i>
                                            </div>
                                            <span class="font-jakarta font-semibold text-[#121212] text-lg">E-Wallet (GoPay, OVO, Dana)</span>
                                        </div>
                                        <i class="ph-fill ph-check-circle text-[#121212]/20 peer-checked:text-[#121212] text-2xl"></i>
                                    </div>
                                </label>
                                <label class="cursor-pointer group">
                                    <input class="sr-only peer" name="payment" type="radio" value="cc">
                                    <div class="flex items-center justify-between border border-[#121212]/10 peer-checked:border-[#121212] peer-checked:bg-[#121212]/5 bg-[#fcfcfc] rounded-2xl p-5 transition-all group-hover:border-[#121212]/30">
                                        <div class="flex items-center gap-5">
                                            <div class="w-12 h-12 bg-white border border-[#121212]/5 flex items-center justify-center rounded-full text-[#121212]">
                                                <i class="ph ph-credit-card text-xl"></i>
                                            </div>
                                            <span class="font-jakarta font-semibold text-[#121212] text-lg">Kartu Kredit / Debit</span>
                                        </div>
                                        <i class="ph-fill ph-check-circle text-[#121212]/20 peer-checked:text-[#121212] text-2xl"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
            
            <!-- Right Column: Order Summary -->
            <div class="lg:col-span-5 xl:col-span-4" x-data="{ deliveryCost: 25000, discount: {{ session('promo_discount', 0) }} }" @update-delivery.window="deliveryCost = $event.detail">
                <div class="outer-shell sticky top-[120px]">
                    <div class="inner-core bg-white p-8">
                        <h2 class="font-display font-semibold text-2xl text-[#121212] border-b border-[#121212]/5 pb-6 mb-6 tracking-tight-display">Ringkasan Pesanan</h2>
                        
                        <!-- Items -->
                        <div class="flex flex-col gap-5 mb-8 max-h-[350px] overflow-y-auto pr-2" style="scrollbar-width: thin; scrollbar-color: #121212 transparent;">
                            @php $subtotal = 0; @endphp
                            @foreach(session('cart', []) as $id => $details)
                                @php $subtotal += $details['price'] * $details['quantity']; @endphp
                                <div class="flex gap-4 items-center">
                                    <div class="w-16 h-16 rounded-[1rem] bg-[#121212]/5 flex-shrink-0 overflow-hidden relative flex items-center justify-center">
                                        @if(isset($details['image']) && $details['image'])
                                            <img class="w-[120%] h-[120%] object-cover object-center absolute" src="{{ str_starts_with($details['image'], 'http') ? $details['image'] : asset($details['image']) }}?v={{ time() }}" alt="{{ $details['name'] }}">
                                        @elseif(strpos(strtolower($details['category']), 'sayur') !== false)
                                            <img class="w-[120%] h-[120%] object-cover object-center absolute" src="https://loremflickr.com/400/400/meat">
                                        @elseif(strpos(strtolower($details['category']), 'es') !== false)
                                            <img class="w-[120%] h-[120%] object-cover object-center absolute" src="https://loremflickr.com/400/400/chicken">
                                        @else
                                            <img class="w-[120%] h-[120%] object-cover object-center absolute" src="https://loremflickr.com/400/400/fish">
                                        @endif
                                    </div>
                                    <div class="flex-grow font-jakarta">
                                        <p class="font-semibold text-[#121212] line-clamp-1">{{ $details['name'] }}</p>
                                        <p class="text-[#121212]/60 text-sm mt-0.5">{{ $details['quantity'] }} x Rp {{ number_format($details['price'], 0, ',', '.') }}</p>
                                    </div>
                                    <span class="font-semibold text-[#121212] font-jakarta">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Promo Code -->
                        <form action="{{ route('checkout.promo') }}" method="POST" class="flex gap-2 mb-8">
                            @csrf
                            <input name="promo_code" class="flex-grow rounded-full border border-[#121212]/10 bg-[#fcfcfc] px-5 py-3 focus:border-[#121212] focus:ring-0 font-jakarta uppercase text-sm" placeholder="Masukkan Kode Promo" type="text">
                            <button type="submit" class="bg-[#121212]/5 text-[#121212] px-6 py-3 rounded-full font-jakarta font-semibold hover:bg-[#121212] hover:text-white transition-colors text-sm">Terapkan</button>
                        </form>
                        
                        <!-- Totals -->
                        <div class="border-t border-[#121212]/5 pt-6 flex flex-col gap-3 mb-8 font-jakarta text-[15px]">
                            <div class="flex justify-between text-[#121212]/70">
                                <span>Subtotal Produk</span>
                                <span class="font-medium text-[#121212]">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-[#121212]/70">
                                <span>Ongkos Kirim</span>
                                <span class="font-medium text-[#121212]" x-text="'Rp ' + deliveryCost.toLocaleString('id-ID')">Rp 25.000</span>
                            </div>
                            @if(session('promo_discount'))
                            <div class="flex justify-between text-green-600 font-medium">
                                <span>Diskon Promo</span>
                                <span>- Rp {{ number_format(session('promo_discount'), 0, ',', '.') }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between items-end mt-4 pt-4 border-t border-[#121212]/5">
                                <span class="font-semibold text-[#121212] text-lg">Total Pembayaran</span>
                                <span class="font-display font-semibold text-3xl text-[#121212] tracking-tight-display" x-text="'Rp ' + ({{ $subtotal }} + deliveryCost - discount).toLocaleString('id-ID')">Rp {{ number_format($subtotal + 25000 - session('promo_discount', 0), 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <button onclick="document.getElementById('checkoutForm').submit()" class="w-full bg-[#121212] text-white font-jakarta font-semibold text-lg py-4 rounded-full shadow-sm hover:bg-black transition-colors active:scale-95 flex items-center justify-center gap-2">
                            Bayar Sekarang
                            <i class="ph ph-arrow-right text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-storefront-layout>
