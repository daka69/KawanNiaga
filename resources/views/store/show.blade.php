<x-storefront-layout>
    <!-- Main Canvas -->
    <main class="flex-1 w-full px-6 md:px-12 pt-[140px] md:pt-[160px] pb-24 max-w-[1400px] mx-auto">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-[#121212]/60 mb-8 mt-6 overflow-x-auto whitespace-nowrap scrollbar-hide font-jakarta">
            <a class="hover:text-[#121212] transition-colors font-medium" href="{{ route('store.index') }}">Beranda</a>
            <i class="ph ph-caret-right text-xs"></i>
            <a class="hover:text-[#121212] transition-colors font-medium" href="{{ route('store.index') }}?category={{ urlencode($product->category) }}">{{ $product->category }}</a>
            <i class="ph ph-caret-right text-xs"></i>
            <span class="text-[#121212] font-semibold">{{ $product->name }}</span>
        </div>

        @if(session('success'))
            <div class="outer-shell mb-8 motion-fluid">
                <div class="inner-core bg-[#121212] text-white p-4 flex items-center gap-3">
                    <i class="ph ph-check-circle text-xl text-green-400"></i>
                    <span class="font-jakarta font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Product Bento Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-24">
            <!-- Hero Image Container (Double Bezel) -->
            <div class="lg:col-span-7 outer-shell group">
                <div class="inner-core bg-white overflow-hidden relative p-4 flex items-center justify-center min-h-[500px]">
                    @if($product->stock < 10)
                    <div class="absolute top-8 left-8 bg-[#121212] text-white font-jakarta text-xs font-semibold px-4 py-2 rounded-full shadow-lg z-20 flex items-center gap-2 border border-white/10 uppercase tracking-widest">
                        <i class="ph ph-fire text-[#FFB800]"></i> Hampir Habis
                    </div>
                    @endif
                    
                    @if($product->image)
                        <img class="w-full h-full object-cover rounded-[1.25rem] group-hover:scale-105 transition-transform duration-700 ease-[cubic-bezier(0.32,0.72,0,1)] z-10" src="{{ str_starts_with($product->image, 'http') ? $product->image : asset($product->image) }}?v={{ time() }}" alt="{{ $product->name }}" onerror="this.onerror=null; this.src='https://loremflickr.com/800/800/food';">
                    @elseif(strpos(strtolower($product->category), 'sayur') !== false)
                        <img class="w-full h-full object-cover rounded-[1.25rem] group-hover:scale-105 transition-transform duration-700 ease-[cubic-bezier(0.32,0.72,0,1)] z-10" src="https://loremflickr.com/800/800/meat" alt="{{ $product->name }}">
                    @elseif(strpos(strtolower($product->category), 'es') !== false)
                        <img class="w-full h-full object-cover rounded-[1.25rem] group-hover:scale-105 transition-transform duration-700 ease-[cubic-bezier(0.32,0.72,0,1)] z-10" src="https://loremflickr.com/800/800/chicken" alt="{{ $product->name }}">
                    @else
                        <img class="w-full h-full object-cover rounded-[1.25rem] group-hover:scale-105 transition-transform duration-700 ease-[cubic-bezier(0.32,0.72,0,1)] z-10" src="https://loremflickr.com/800/800/fish" alt="{{ $product->name }}">
                    @endif
                </div>
            </div>

            <!-- Product Details Container -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                <div class="outer-shell h-full shadow-sm hover:shadow-ambient motion-fluid">
                    <div class="inner-core bg-white p-8 md:p-10 h-full flex flex-col">
                        <div class="mb-6">
                            <span class="text-xs uppercase tracking-widest text-[#121212]/40 font-semibold mb-3 block font-jakarta">{{ $product->category }}</span>
                            <h1 class="text-4xl md:text-5xl font-display font-semibold text-[#121212] mb-4 tracking-tight-display">{{ $product->name }}</h1>
                            <p class="text-lg font-jakarta text-[#121212]/60 leading-relaxed">{{ $product->description ?? 'Produk berkualitas tinggi. Diproses dan dibekukan dengan teknologi cold-storage modern untuk menjaga kesegaran maksimal.' }}</p>
                        </div>

                        <div class="flex items-end gap-4 mb-8 pb-8 border-b border-[#121212]/5">
                            <span class="text-4xl font-semibold text-[#121212] font-display tracking-tight-display">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</span>
                        </div>

                        <!-- Fun Stock Indicator -->
                        @if($product->stock < 10)
                        <div class="bg-red-50 border border-red-100 rounded-xl p-4 mb-8 flex items-center gap-3">
                            <i class="ph ph-warning-circle text-red-600 text-xl animate-pulse"></i>
                            <span class="text-red-700 font-jakarta font-semibold text-sm">Sisa {{ $product->stock }} Pcs lagi! Yuk diserbu!</span>
                        </div>
                        @else
                        <div class="bg-[#fcfcfc] border border-[#121212]/5 rounded-xl p-4 mb-8 flex items-center gap-3">
                            <i class="ph ph-package text-[#121212]/60 text-xl"></i>
                            <span class="text-[#121212]/70 font-jakarta font-medium text-sm">Stok Tersedia: <span class="text-[#121212] font-semibold">{{ $product->stock }} Pcs</span></span>
                        </div>
                        @endif

                        @auth
                        <form action="{{ route('cart.add') }}" method="POST" class="mt-auto space-y-6">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <!-- Quantity Picker -->
                            <div x-data="{ qty: 1, maxQty: {{ $product->stock }} }" class="flex items-center justify-between bg-[#fcfcfc] border border-[#121212]/10 rounded-full p-2 shadow-sm">
                                <span class="text-[#121212]/70 font-jakarta font-medium pl-6">Kuantitas</span>
                                <div class="flex items-center gap-4 bg-[#121212]/5 rounded-full p-1">
                                    <button type="button" @click="if(qty > 1) qty--" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-[#121212] hover:bg-[#121212] hover:text-white transition-colors shadow-sm">
                                        <i class="ph ph-minus"></i>
                                    </button>
                                    <input type="number" name="quantity" x-model="qty" min="1" :max="maxQty" class="font-jakarta font-semibold text-[#121212] text-lg w-12 text-center bg-transparent border-none focus:ring-0 appearance-none p-0">
                                    <button type="button" @click="if(qty < maxQty) qty++" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-[#121212] hover:bg-[#121212] hover:text-white transition-colors shadow-sm">
                                        <i class="ph ph-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- CTA -->
                            <div class="flex gap-4">
                                <button type="submit" class="w-full bg-[#121212] text-white font-jakarta font-semibold text-lg py-4 rounded-full shadow-sm hover:bg-black transition-colors flex items-center justify-center gap-2 group active:scale-95 duration-150">
                                    <i class="ph ph-shopping-bag text-xl"></i> Tambah ke Keranjang
                                </button>
                            </div>
                        </form>
                        @else
                        <div class="mt-auto space-y-6">
                            <a href="{{ route('login') }}" class="w-full bg-[#121212] text-white font-jakarta font-semibold text-lg py-4 rounded-full shadow-sm hover:bg-black transition-colors flex items-center justify-center gap-2 group active:scale-95 duration-150">
                                <i class="ph ph-sign-in text-xl"></i> Masuk untuk Membeli
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Perfect Pairings Carousel -->
        <section class="mt-20 outer-shell shadow-sm">
            <div class="inner-core bg-white p-8 md:p-12">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-3xl font-display font-semibold text-[#121212] flex items-center gap-3 tracking-tight-display">
                        <i class="ph ph-sparkle text-[#121212]/40"></i> Pilihan Segar Lainnya
                    </h2>
                </div>
                <p class="text-sm font-jakarta text-[#121212]/50 mb-10">Mungkin Anda juga menyukai produk-produk segar kami lainnya.</p>
                
                <div class="flex gap-6 overflow-x-auto pb-6 scrollbar-hide snap-x">
                    @forelse($relatedProducts as $related)
                    <a href="{{ route('store.show', $related->id) }}" class="min-w-[260px] max-w-[260px] flex-shrink-0 outer-shell group snap-start block">
                        <div class="inner-core bg-[#fcfcfc] p-2 flex flex-col relative overflow-hidden h-full">
                            <div class="h-[200px] rounded-[1rem] overflow-hidden bg-[#121212]/5 mb-4">
                                @if($related->image)
                                    <img class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-700 ease-[cubic-bezier(0.32,0.72,0,1)]" src="{{ str_starts_with($related->image, 'http') ? $related->image : asset($related->image) }}" alt="{{ $related->name }}" onerror="this.onerror=null; this.src='https://loremflickr.com/800/800/food';">
                                @else
                                    <img class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-700 ease-[cubic-bezier(0.32,0.72,0,1)]" src="https://loremflickr.com/800/800/dish" alt="{{ $related->name }}">
                                @endif
                            </div>
                            <div class="px-2 pb-2">
                                <h3 class="font-jakarta font-semibold text-[#121212] mb-1 truncate">{{ $related->name }}</h3>
                                <p class="text-[#121212]/60 font-jakarta text-sm">Rp {{ number_format($related->selling_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </a>
                    @empty
                    <p class="text-[#121212]/50 font-jakarta text-sm italic">Belum ada rekomendasi lainnya saat ini.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
</x-storefront-layout>
