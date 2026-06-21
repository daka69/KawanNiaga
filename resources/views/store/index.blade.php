<x-storefront-layout>
    <main class="flex-grow pt-[140px] md:pt-[160px] relative z-10">
        <!-- The Editorial Split Hero -->
        <section class="relative w-full max-w-[1400px] mx-auto px-6 md:px-12 flex flex-col lg:flex-row gap-16 lg:gap-24 items-center justify-between min-h-[75vh] mb-8">
            <!-- Left: Massive Typography -->
            <div class="w-full lg:w-1/2 flex flex-col gap-8 gsap-hero-container">
                <div class="gsap-hero-el opacity-0 inline-flex items-center gap-3 px-4 py-2 rounded-full outer-shell w-max">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-[11px] font-jakarta font-semibold tracking-widest uppercase text-[#121212]/60">Sajian Premium</span>
                </div>
                
                <h1 class="gsap-hero-el opacity-0 text-6xl md:text-7xl lg:text-[5.5rem] leading-[1.05] font-display font-semibold tracking-tight-display text-[#121212]">
                    Praktis.<br>Lezat.<br><span class="text-[#121212]/30">Segar.</span>
                </h1>
                
                <p class="gsap-hero-el opacity-0 text-lg md:text-xl font-jakarta text-[#121212]/60 max-w-md leading-relaxed">
                    Kualitas hidangan restoran, kini hadir di meja makan Anda. Kami kurasi bahan baku terbaik untuk kebahagiaan keluarga Anda.
                </p>
                
                <!-- Double Bezel CTA / Magnetic -->
                <div class="gsap-hero-el opacity-0 mt-4">
                    <a href="#katalog" class="group inline-flex items-center bg-[#121212] text-white rounded-full pl-8 pr-2 py-2 btn-magnetic shadow-ambient">
                        <span class="font-jakarta font-medium text-[16px] mr-6">Eksplorasi Katalog</span>
                        <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center inner-icon">
                            <i class="ph ph-arrow-down text-lg"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Right: Z-Axis Cascade Imagery -->
            <div class="gsap-hero-images opacity-0 w-full lg:w-1/2 relative h-[400px] md:h-[500px] flex items-center justify-center">
                <!-- Ambient Glow -->
                <div class="absolute inset-0 bg-[#121212]/5 rounded-full transform scale-75 blur-3xl z-0"></div>
                
                <!-- Main Focus Card (Double-Bezel) -->
                <div class="absolute z-20 w-[55%] max-w-[280px] aspect-[3/4] outer-shell transform rotate-2 translate-x-12 -translate-y-4 hover:rotate-0 hover:translate-x-8 hover:-translate-y-6 motion-fluid shadow-ambient">
                    <div class="inner-core w-full h-full p-2 overflow-hidden relative group">
                        <img class="w-full h-full object-cover rounded-[1.5rem] group-hover:scale-105 motion-fluid" src="https://loremflickr.com/800/1200/meat" alt="Premium Meat">
                        <div class="absolute bottom-4 left-4 right-4 bg-white/90 backdrop-blur-xl rounded-2xl p-4 shadow-sm border border-white/50">
                            <p class="text-sm font-jakarta font-semibold text-[#121212]">Premium Quality</p>
                            <p class="text-[10px] text-[#121212]/50 uppercase tracking-widest mt-1">Ready to Cook</p>
                        </div>
                    </div>
                </div>
                
                <!-- Secondary Stacked Card -->
                <div class="absolute z-10 w-[45%] max-w-[220px] aspect-square outer-shell transform -rotate-6 -translate-x-16 translate-y-16 hover:-rotate-3 hover:-translate-x-20 hover:translate-y-12 motion-fluid">
                    <div class="inner-core w-full h-full p-2 overflow-hidden relative group">
                        <img class="w-full h-full object-cover rounded-[1.5rem] group-hover:scale-105 motion-fluid grayscale hover:grayscale-0" src="https://loremflickr.com/800/800/fish" alt="Fresh Salmon">
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="w-full bg-[#121212] relative z-10 py-20">
            <div class="max-w-[1400px] mx-auto px-6 md:px-12">
                <h2 class="text-center text-3xl md:text-4xl font-display font-semibold text-white mb-16 tracking-tight-display">Mudah, Cepat, Segar.</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                    <!-- Step 1 -->
                    <div class="gsap-step-card opacity-0 flex flex-col items-center text-center px-8 py-8 relative">
                        <div class="absolute top-8 right-0 hidden md:block w-px h-24 bg-white/10"></div>
                        <span class="text-[80px] font-display font-semibold text-white/10 leading-none mb-4">01</span>
                        <h3 class="text-xl font-display font-semibold text-white mb-3">Pilih Produk</h3>
                        <p class="text-white/50 font-jakarta text-sm leading-relaxed">Jelajahi katalog kami dan temukan bahan makanan segar yang Anda butuhkan.</p>
                    </div>
                    <!-- Step 2 -->
                    <div class="gsap-step-card opacity-0 flex flex-col items-center text-center px-8 py-8 relative">
                        <div class="absolute top-8 right-0 hidden md:block w-px h-24 bg-white/10"></div>
                        <span class="text-[80px] font-display font-semibold text-white/10 leading-none mb-4">02</span>
                        <h3 class="text-xl font-display font-semibold text-white mb-3">Tambah ke Keranjang</h3>
                        <p class="text-white/50 font-jakarta text-sm leading-relaxed">Atur kuantitas pesanan sesuai kebutuhan dan proses checkout dengan mudah.</p>
                    </div>
                    <!-- Step 3 -->
                    <div class="gsap-step-card opacity-0 flex flex-col items-center text-center px-8 py-8">
                        <span class="text-[80px] font-display font-semibold text-white/10 leading-none mb-4">03</span>
                        <h3 class="text-xl font-display font-semibold text-white mb-3">Terima di Rumah</h3>
                        <p class="text-white/50 font-jakarta text-sm leading-relaxed">Bahan makanan segar tiba langsung di depan pintu Anda, siap diolah.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features / Value Proposition Section -->
        <section class="max-w-[1400px] mx-auto px-6 md:px-12 py-16 mb-8 border-b border-[#121212]/5 relative z-10 bg-[#FDFBF7]">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-24">
                <div class="gsap-feature-card opacity-0 flex flex-col items-center text-center group">
                    <div class="w-20 h-20 rounded-full bg-[#121212]/5 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-[#121212] group-hover:text-white transition-all duration-300">
                        <i class="ph ph-plant text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-display font-semibold text-[#121212] mb-3">100% Segar Harian</h3>
                    <p class="text-[#121212]/60 font-jakarta leading-relaxed">Bahan baku dipanen dan dipotong setiap pagi, memastikan kesegaran optimal hingga ke dapur Anda.</p>
                </div>
                <div class="gsap-feature-card opacity-0 flex flex-col items-center text-center group">
                    <div class="w-20 h-20 rounded-full bg-[#121212]/5 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-[#121212] group-hover:text-white transition-all duration-300">
                        <i class="ph ph-shield-check text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-display font-semibold text-[#121212] mb-3">Kualitas Restoran</h3>
                    <p class="text-[#121212]/60 font-jakarta leading-relaxed">Standar kebersihan dan seleksi ketat yang biasa digunakan oleh koki restoran bintang lima.</p>
                </div>
                <div class="gsap-feature-card opacity-0 flex flex-col items-center text-center group">
                    <div class="w-20 h-20 rounded-full bg-[#121212]/5 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-[#121212] group-hover:text-white transition-all duration-300">
                        <i class="ph ph-truck text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-display font-semibold text-[#121212] mb-3">Pengiriman Cepat</h3>
                    <p class="text-[#121212]/60 font-jakarta leading-relaxed">Didukung dengan armada pengiriman berpendingin khusus, tiba di depan pintu Anda di hari yang sama.</p>
                </div>
            </div>
        </section>

        <!-- Main Content Area -->
        <section class="max-w-[1400px] mx-auto px-6 md:px-12 py-16 flex flex-col lg:flex-row gap-16 relative" id="katalog">
            
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

            <!-- Featured Header -->
            <div class="flex-grow w-full">
                <div class="flex items-center justify-between mb-12">
                    <h2 class="text-4xl font-display font-semibold text-[#121212] tracking-tight-display">Produk Terlaris</h2>
                    <a href="{{ route('store.catalog') }}" class="text-[#121212]/60 hover:text-[#121212] font-jakarta font-medium transition-colors flex items-center gap-2">
                        Lihat Semua <i class="ph ph-arrow-right"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 w-full">
                    @forelse($featuredProducts as $p)
                    <div class="gsap-product-card opacity-0 outer-shell group hover:-translate-y-2 motion-fluid shadow-sm hover:shadow-ambient">
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
                                @if($p->image)
                                    <img class="w-full h-full object-cover group-hover:scale-105 motion-fluid" src="{{ str_starts_with($p->image, 'http') ? $p->image : asset($p->image) }}?v={{ time() }}" alt="{{ $p->name }}" onerror="this.onerror=null; this.src='https://loremflickr.com/600/600/food';">
                                @else
                                    <img class="w-full h-full object-cover group-hover:scale-105 motion-fluid" src="https://loremflickr.com/600/600/dish" alt="{{ $p->name }}">
                                @endif
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
                
                </div>
                
                <div class="mt-16 flex justify-center">
                    <a href="{{ route('store.catalog') }}" class="bg-white border border-[#121212]/10 text-[#121212] rounded-full px-8 py-4 font-jakarta font-semibold text-lg hover:bg-[#121212]/5 transition-colors shadow-sm inline-flex items-center gap-2 group active:scale-95 duration-150">
                        Jelajahi Semua Produk <i class="ph ph-arrow-right group-hover:translate-x-2 transition-transform"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- Cinematic Promo Banner -->
        <section class="max-w-[1400px] mx-auto px-6 md:px-12 py-16 mb-32">
            <div class="gsap-promo-banner opacity-0 relative w-full rounded-[2rem] overflow-hidden bg-[#121212] h-[400px] md:h-[500px] flex items-center justify-center group shadow-ambient">
                <img class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:scale-105 group-hover:opacity-40 transition-all duration-1000" src="https://loremflickr.com/1600/900/grill" alt="Promo Promo">
                <div class="relative z-10 text-center px-6 max-w-3xl flex flex-col items-center">
                    <span class="text-white/80 font-jakarta font-semibold tracking-widest uppercase text-sm mb-4 block">Eksklusif Akhir Pekan</span>
                    <h2 class="text-5xl md:text-7xl font-display font-semibold text-white mb-6 tracking-tight-display leading-tight">Pesta BBQ Keluarga Di Rumah.</h2>
                    <a href="{{ route('store.catalog') }}" class="mt-4 bg-white text-[#121212] rounded-full px-8 py-4 font-jakarta font-semibold text-[16px] hover:scale-105 transition-transform shadow-lg shadow-black/20 flex items-center gap-2">
                        Belanja Paket Spesial <i class="ph ph-arrow-right"></i>
                    </a>
                </div>
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

            // Features Stagger Reveal
            gsap.fromTo(".gsap-feature-card",
                { y: 50, opacity: 0 },
                { 
                    y: 0, opacity: 1, duration: 1, stagger: 0.15, ease: "power3.out",
                    scrollTrigger: {
                        trigger: ".gsap-feature-card",
                        start: "top 85%",
                    }
                }
            );

            // How It Works Steps Reveal
            gsap.fromTo(".gsap-step-card",
                { y: 40, opacity: 0 },
                { 
                    y: 0, opacity: 1, duration: 1, stagger: 0.2, ease: "power3.out",
                    scrollTrigger: {
                        trigger: ".gsap-step-card",
                        start: "top 85%",
                    }
                }
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

            // Promo Banner Reveal
            gsap.fromTo(".gsap-promo-banner",
                { scale: 0.95, opacity: 0, y: 50 },
                { 
                    scale: 1, opacity: 1, y: 0, duration: 1.5, ease: "expo.out",
                    scrollTrigger: {
                        trigger: ".gsap-promo-banner",
                        start: "top 90%",
                    }
                }
            );
        });
    </script>
</x-storefront-layout>
