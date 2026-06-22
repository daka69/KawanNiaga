<x-storefront-layout>
    <main class="flex-grow pt-[140px] md:pt-[160px] relative z-10">
        <!-- Catalog Header -->
        <div class="max-w-[1400px] mx-auto px-6 md:px-12 mb-8" x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 100)">
            <h1 class="text-5xl md:text-6xl font-display font-semibold tracking-tight-display text-[#121212] transition-all duration-1000 transform" :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                Katalog Produk
            </h1>
            <p class="text-lg font-jakarta text-[#121212]/60 mt-4 transition-all duration-1000 delay-100 transform" :class="loaded ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                Eksplorasi koleksi bahan makanan premium dan segar kami.
            </p>
        </div>

        <!-- Main Content Area -->
        <section class="max-w-[1400px] mx-auto px-6 md:px-12 py-12 flex flex-col lg:flex-row gap-16 relative" id="katalog">
            
            @if(session('error'))
                <div class="absolute top-0 left-0 w-full bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl mb-8 shadow-sm z-50 text-center font-jakarta">
                    <span class="block sm:inline font-semibold">{{ session('error') }}</span>
                </div>
            @endif
            @if(session('success'))
                <div class="absolute top-0 left-0 w-full bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl mb-8 shadow-sm z-50 text-center font-jakarta">
                    <span class="block sm:inline font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <!-- SideNavBar -->
            <aside class="hidden lg:flex flex-col w-[280px] h-fit sticky top-32 flex-shrink-0 z-20">
                <!-- Category Tabs (Desktop) -->
                <div class="outer-shell w-full">
                    <div class="inner-core p-6">
                        <div class="flex flex-col items-start mb-6 pb-6 border-b border-[#121212]/5">
                            <h3 class="text-[#121212] font-display font-medium text-2xl tracking-tight-display">Kategori</h3>
                        </div>
                        <!-- Navigation Links -->
                        <nav class="flex flex-col gap-2">
                            <a class="gsap-category-card opacity-0 {{ !request('category') ? 'bg-[#121212] text-white' : 'text-[#121212]/60 hover:bg-[#121212]/5' }} rounded-xl px-4 py-3 flex items-center gap-3 font-jakarta font-medium transition-colors" href="{{ route('store.catalog', array_merge(request()->except('category', 'page'))) }}">
                                <i class="ph ph-squares-four text-lg"></i> Semua Produk
                            </a>
                            @foreach($categories as $cat)
                            <a class="gsap-category-card opacity-0 {{ request('category') == $cat ? 'bg-[#121212] text-white' : 'text-[#121212]/60 hover:bg-[#121212]/5' }} rounded-xl px-4 py-3 flex items-center gap-3 font-jakarta font-medium transition-colors" href="{{ route('store.catalog', array_merge(request()->except('page'), ['category' => $cat])) }}">
                                <i class="ph ph-tag text-lg"></i> {{ $cat }}
                            </a>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </aside>

            <!-- Catalog Grid -->
            <div class="flex-grow w-full">
                <!-- Category Tabs Mobile -->
                <div class="lg:hidden flex overflow-x-auto pb-6 mb-2 gap-3 scrollbar-hide">
                    <a href="{{ route('store.catalog', request()->except('category', 'page')) }}" class="whitespace-nowrap px-6 py-2.5 {{ !request('category') ? 'bg-[#121212] text-white' : 'bg-transparent text-[#121212]/60 border border-[#121212]/10 hover:bg-[#121212]/5' }} rounded-full font-jakarta font-medium transition-colors">Semua</a>
                    @foreach($categories as $cat)
                    <a href="{{ route('store.catalog', array_merge(request()->except('page'), ['category' => $cat])) }}" class="whitespace-nowrap px-6 py-2.5 {{ request('category') == $cat ? 'bg-[#121212] text-white' : 'bg-transparent text-[#121212]/60 border border-[#121212]/10 hover:bg-[#121212]/5' }} rounded-full font-jakarta font-medium transition-colors">{{ $cat }}</a>
                    @endforeach
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 w-full">
                    @forelse($products as $p)
                    <!-- Asymmetrical Bento Card (Double Bezel) -->
                    <div class="gsap-product-card opacity-0 outer-shell group hover:-translate-y-2 motion-fluid shadow-sm hover:shadow-ambient @if($loop->iteration % 4 == 1 || $loop->iteration % 4 == 0) md:col-span-7 @else md:col-span-5 @endif">
                        <div class="inner-core h-full flex flex-col p-2 relative overflow-hidden bg-white">
                            @if($loop->first)
                                <div class="absolute top-6 left-6 z-20 bg-[#121212] text-white px-4 py-1.5 rounded-full text-[10px] uppercase tracking-widest font-semibold shadow-xl border border-white/10">Bestseller</div>
                            @endif
                            
                            <!-- Image Container -->
                            <a href="{{ route('store.show', $p->id) }}" class="relative w-full aspect-[4/3] rounded-[1.25rem] bg-[#f5f5f5] overflow-hidden mb-4 cursor-pointer block">
                                <div class="absolute inset-0 bg-[#121212]/0 group-hover:bg-[#121212]/5 transition-colors z-10 flex items-center justify-center">
                                    <div class="bg-white/90 backdrop-blur-md text-[#121212] px-6 py-2 rounded-full font-jakarta font-medium text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0 flex items-center gap-2 shadow-sm border border-white">
                                        <i class="ph ph-eye text-lg"></i> View
                                    </div>
                                </div>
                                <img class="w-full h-full object-cover group-hover:scale-105 motion-fluid" src="https://upload.wikimedia.org/wikipedia/commons/6/64/Foods_%28cropped%29.jpg" alt="{{ $p->name }}">
                            </a>
                            
                            <!-- Content Details -->
                            <div class="px-4 pb-4 flex flex-col flex-grow">
                                <span class="text-[10px] uppercase tracking-widest text-[#121212]/40 font-semibold mb-2 block">{{ $p->category }}</span>
                                <a href="{{ route('store.show', $p->id) }}" class="text-2xl font-display font-medium text-[#121212] mb-6 line-clamp-2 hover:opacity-70 transition-opacity">{{ $p->name }}</a>
                                
                                <div class="mt-auto flex items-center justify-between border-t border-[#121212]/5 pt-4">
                                    <span class="text-xl font-jakarta font-semibold text-[#121212]">Rp {{ number_format($p->selling_price, 0, ',', '.') }}</span>
                                    @auth
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $p->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="w-12 h-12 rounded-full bg-[#121212]/5 text-[#121212] hover:bg-[#121212] hover:text-white flex items-center justify-center transition-colors shadow-sm active:scale-95 duration-150">
                                                <i class="ph ph-shopping-bag text-xl"></i>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="w-12 h-12 rounded-full bg-[#121212]/5 text-[#121212] hover:bg-[#121212] hover:text-white flex items-center justify-center transition-colors shadow-sm active:scale-95 duration-150">
                                            <i class="ph ph-shopping-bag text-xl"></i>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-12 outer-shell">
                        <div class="inner-core p-16 text-center flex flex-col items-center justify-center">
                            <div class="w-20 h-20 bg-[#121212]/5 rounded-full flex items-center justify-center mb-6">
                                <i class="ph ph-package text-4xl text-[#121212]/40"></i>
                            </div>
                            <h3 class="text-3xl font-display font-medium text-[#121212] mb-3 tracking-tight-display">Katalog Kosong</h3>
                            <p class="text-[#121212]/60 font-jakarta max-w-md">Belum ada produk yang ditambahkan ke toko saat ini. Silakan cek kembali nanti.</p>
                        </div>
                    </div>
                    @endforelse
                </div>
                
                @if($products->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $products->appends(request()->query())->links('vendor.pagination.tailwind') }}
                </div>
                @endif
            </div>
        </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            gsap.registerPlugin(ScrollTrigger);

            // Cinematic Hero Text Reveal (Hanya Sekali di Awal)
            gsap.fromTo(".gsap-hero-el", 
                { y: 80, opacity: 0, rotateX: -30, transformOrigin: "bottom center" }, 
                { y: 0, opacity: 1, rotateX: 0, duration: 1.5, stagger: 0.2, ease: "power4.out" }
            );

            // Hero Image Entry (Hanya Sekali di Awal)
            gsap.fromTo(".gsap-hero-images",
                { scale: 0.8, opacity: 0, y: 50, rotate: -5 },
                { scale: 1, opacity: 1, y: 0, rotate: 0, duration: 2, ease: "power3.out", delay: 0.2 }
            );

            // Category Horizontal Stagger Reveal (Hanya Sekali saat di-scroll)
            gsap.fromTo(".gsap-category-card",
                { x: -50, opacity: 0 },
                { 
                    x: 0, opacity: 1, duration: 1, stagger: 0.1, ease: "back.out(1.7)",
                    scrollTrigger: {
                        trigger: ".gsap-category-card",
                        start: "top 85%",
                        // Secara default GSAP berjalan satu kali
                    }
                }
            );

            // Product Grid Upward Stagger Reveal (Hanya Sekali saat di-scroll)
            gsap.utils.toArray(".gsap-product-card").forEach((card, i) => {
                gsap.fromTo(card,
                    { y: 100, opacity: 0, scale: 0.9 },
                    {
                        y: 0, opacity: 1, scale: 1, duration: 1.2, ease: "expo.out",
                        scrollTrigger: {
                            trigger: card,
                            start: "top 85%",
                            // Secara default GSAP berjalan satu kali
                        }
                    }
                );
            });
        });
    </script>
</x-storefront-layout>
