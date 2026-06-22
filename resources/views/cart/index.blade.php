<x-storefront-layout>
    <main class="flex-grow pt-[140px] md:pt-[160px] pb-16 px-6 md:px-12 max-w-[1400px] mx-auto w-full flex flex-col md:flex-row gap-8 relative">

        <!-- Left Column: Cart Items -->
        <div class="w-full md:w-2/3 flex flex-col gap-6 z-10">
            <div class="flex items-center gap-3 mb-2">
                <i class="ph ph-shopping-cart text-[#121212] text-3xl"></i>
                <h1 class="font-display font-semibold text-3xl text-[#121212] tracking-tight-display">Keranjang Belanja</h1>
            </div>

            @if(session('error'))
                <div class="outer-shell mb-4 motion-fluid">
                    <div class="inner-core bg-[#121212] text-white p-4 flex items-center gap-3">
                        <i class="ph ph-warning-circle text-xl text-red-400"></i>
                        <span class="font-jakarta font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif
            @if(session('success'))
                <div class="outer-shell mb-4 motion-fluid">
                    <div class="inner-core bg-[#121212] text-white p-4 flex items-center gap-3">
                        <i class="ph ph-check-circle text-xl text-green-400"></i>
                        <span class="font-jakarta font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @php $total = 0; @endphp
            @if(session('cart') && count(session('cart')) > 0)
                @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <!-- Cart Item -->
                    <div class="outer-shell group">
                        <div class="inner-core bg-white p-4 md:p-6 flex flex-col sm:flex-row items-center gap-6">
                            <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-[1rem] bg-[#121212]/5 overflow-hidden flex-shrink-0 relative flex items-center justify-center">
                                <img class="w-full h-full object-cover object-center absolute" src="https://upload.wikimedia.org/wikipedia/commons/6/64/Foods_%28cropped%29.jpg" alt="{{ $details['name'] }}">
                            </div>
                            <div class="flex-grow flex flex-col w-full">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-jakarta font-semibold text-[#121212] text-xl">{{ $details['name'] }}</h3>
                                        <p class="text-[#121212]/60 text-sm mt-1 font-jakarta">Rp {{ number_format($details['price'], 0, ',', '.') }} / item</p>
                                    </div>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="text-[#121212]/40 hover:text-red-500 transition-colors bg-[#121212]/5 hover:bg-red-50 w-10 h-10 rounded-full flex items-center justify-center">
                                            <i class="ph ph-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="flex justify-between items-end mt-4">
                                    <!-- Quantity Picker -->
                                    <form action="{{ route('cart.update') }}" method="POST" class="flex items-center bg-[#fcfcfc] rounded-full border border-[#121212]/10 p-1" x-data="{ qty: {{ $details['quantity'] }} }">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" @click="if(qty > 1) qty--" name="quantity" :value="qty - 1" class="w-8 h-8 rounded-full bg-white text-[#121212] flex items-center justify-center hover:bg-[#121212] hover:text-white transition-colors shadow-sm">
                                            <i class="ph ph-minus text-sm"></i>
                                        </button>
                                        <span class="font-jakarta font-semibold text-[#121212] w-10 text-center" x-text="qty"></span>
                                        <button type="submit" @click="qty++" name="quantity" :value="qty + 1" class="w-8 h-8 rounded-full bg-white text-[#121212] flex items-center justify-center hover:bg-[#121212] hover:text-white transition-colors shadow-sm">
                                            <i class="ph ph-plus text-sm"></i>
                                        </button>
                                    </form>
                                    <div class="font-display font-semibold text-[#121212] text-2xl tracking-tight-display">
                                        Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <!-- Add-on suggestion -->
                <div class="outer-shell mt-2">
                    <div class="inner-core bg-[#fcfcfc] p-6 flex flex-col sm:flex-row items-center gap-6 border-dashed">
                        <div class="w-16 h-16 rounded-full bg-[#121212]/5 flex items-center justify-center flex-shrink-0 text-[#121212]">
                            <i class="ph ph-sparkle text-3xl"></i>
                        </div>
                        <div class="flex-grow text-center sm:text-left mb-4 sm:mb-0">
                            <h4 class="font-jakarta font-semibold text-[#121212] text-lg">Tambah Produk Lain?</h4>
                            <p class="text-sm text-[#121212]/60 font-jakarta mt-1">Lengkapi belanjaan kamu sebelum checkout!</p>
                        </div>
                        <a href="{{ route('store.index') }}" class="px-6 py-3 rounded-full border border-[#121212] text-[#121212] hover:bg-[#121212] hover:text-white transition-colors font-jakarta font-semibold text-sm whitespace-nowrap active:scale-95">
                            Lihat Katalog
                        </a>
                    </div>
                </div>
            @else
                <div class="outer-shell">
                    <div class="inner-core bg-white p-12 flex flex-col items-center justify-center text-center min-h-[300px]">
                        <div class="w-24 h-24 bg-[#121212]/5 rounded-full flex items-center justify-center mb-6">
                            <i class="ph ph-shopping-cart text-5xl text-[#121212]/40"></i>
                        </div>
                        <h3 class="font-display font-semibold text-2xl text-[#121212] mb-3 tracking-tight-display">Keranjang Kosong</h3>
                        <p class="text-[#121212]/60 font-jakarta mb-8 text-lg">Kamu belum memasukkan produk apapun ke keranjang.</p>
                        <a href="{{ route('store.index') }}" class="bg-[#121212] hover:bg-black px-8 py-4 rounded-full font-jakarta font-semibold text-white transition-colors active:scale-95 shadow-sm">
                            Belanja Sekarang
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Column: Checkout Summary -->
        <div class="w-full md:w-1/3 z-10">
            <div class="outer-shell sticky top-28">
                <div class="inner-core bg-white p-8 flex flex-col gap-6">
                    <h2 class="font-display font-semibold text-2xl text-[#121212] tracking-tight-display">Ringkasan Belanja</h2>
                    
                    @if(session('cart') && count(session('cart')) > 0)
                        <div class="flex flex-col gap-4 font-jakarta text-[#121212]/70">
                            <div class="flex justify-between">
                                <span>Total Harga ({{ array_sum(array_column(session('cart'), 'quantity')) }} Barang)</span>
                                <span class="font-semibold text-[#121212]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="flex items-center gap-2">
                                    <i class="ph ph-snowflake text-[#121212]/50"></i>
                                    Cold Chain Express
                                </span>
                                <span class="font-semibold text-[#121212]">Rp 0</span>
                            </div>
                        </div>
                        
                        <div class="h-px w-full bg-[#121212]/10 my-2"></div>
                        
                        <div class="flex justify-between items-end">
                            <span class="font-jakarta font-semibold text-[#121212] text-lg">Total Tagihan</span>
                            <span class="font-display font-semibold text-3xl text-[#121212] tracking-tight-display">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        
                        <a href="{{ route('checkout.index') }}" class="bg-[#121212] hover:bg-black text-white w-full py-4 rounded-full font-jakarta font-semibold text-lg flex justify-center items-center gap-2 mt-4 transition-colors active:scale-95 shadow-sm">
                            Lanjut ke Pembayaran
                            <i class="ph ph-arrow-right text-xl"></i>
                        </a>
                        <p class="text-xs text-center text-[#121212]/50 flex items-center justify-center gap-1.5 mt-2 font-jakarta">
                            <i class="ph ph-shield-check"></i>
                            Pembayaran aman & terenkripsi
                        </p>
                    @else
                        <div class="flex flex-col gap-4 font-jakarta text-[#121212]/40">
                            <div class="flex justify-between">
                                <span>Total Harga (0 Barang)</span>
                                <span class="font-semibold">Rp 0</span>
                            </div>
                        </div>
                        <div class="h-px w-full bg-[#121212]/5 my-2"></div>
                        <div class="flex justify-between items-end opacity-40">
                            <span class="font-jakarta font-semibold text-[#121212] text-lg">Total Tagihan</span>
                            <span class="font-display font-semibold text-3xl text-[#121212]">Rp 0</span>
                        </div>
                        <button disabled class="bg-[#121212]/10 text-[#121212]/40 w-full py-4 rounded-full font-jakarta font-semibold text-lg mt-4 cursor-not-allowed">
                            Lanjut ke Pembayaran
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </main>
</x-storefront-layout>
