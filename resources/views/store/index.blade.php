<x-storefront-layout>
<main class="flex-grow relative z-10">

    {{-- ══════════════════════════════════════
         HERO SECTION
    ══════════════════════════════════════ --}}
    <section class="w-full max-w-[1400px] mx-auto px-6 md:px-12 pt-[130px] md:pt-[150px] pb-20 flex flex-col lg:flex-row items-center gap-12 lg:gap-20">

        {{-- Left: Text --}}
        <div class="w-full lg:w-[55%] flex flex-col gap-7">
            <div class="inline-flex items-center gap-2.5 bg-green-50 border border-green-200 text-green-700 px-4 py-1.5 rounded-full w-max">
                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse block"></span>
                <span class="text-[12px] font-jakarta font-semibold tracking-wider uppercase">Bahan Segar Setiap Hari</span>
            </div>

            <h1 class="text-[3.5rem] md:text-[4.5rem] lg:text-[5rem] leading-[1.08] font-display font-semibold text-[#1a1a1a] tracking-tight">
                Belanja Bahan<br>
                <span class="text-[#1a1a1a]/30">Makanan Segar,</span><br>
                Tanpa Repot.
            </h1>

            <p class="text-[1.1rem] font-jakarta text-[#1a1a1a]/60 max-w-lg leading-relaxed">
                Dari dapur restoran ke meja makan Anda. Temukan daging, seafood, sayuran beku, dan bahan masak berkualitas premium — dikirim langsung ke pintu rumah Anda.
            </p>

            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mt-2">
                <a href="{{ route('store.catalog') }}" class="bg-[#1a1a1a] text-white font-jakarta font-semibold text-[15px] px-8 py-4 rounded-full hover:bg-black transition-all hover:scale-105 active:scale-95 shadow-lg shadow-black/10 flex items-center gap-2">
                    Mulai Belanja <i class="ph ph-arrow-right"></i>
                </a>
                <a href="{{ route('store.catalog') }}" class="text-[#1a1a1a] font-jakarta font-medium text-[15px] px-6 py-4 rounded-full border border-[#1a1a1a]/10 hover:bg-[#1a1a1a]/5 transition-all flex items-center gap-2">
                    <i class="ph ph-magnifying-glass"></i> Jelajahi Katalog
                </a>
            </div>
        </div>

        {{-- Right: Product Image Stack --}}
        <div class="w-full lg:w-[45%] relative h-[380px] md:h-[460px] flex items-center justify-center flex-shrink-0">
            {{-- Background blob --}}
            <div class="absolute w-[70%] h-[70%] rounded-full bg-orange-50 blur-3xl z-0 top-[15%] left-[15%]"></div>

            {{-- Main product card --}}
            <div class="absolute z-20 w-[52%] max-w-[260px] aspect-[3/4] bg-white rounded-[2rem] shadow-2xl shadow-black/10 overflow-hidden border border-black/5 transform rotate-3 translate-x-10 -translate-y-4 hover:rotate-1 hover:translate-x-8 transition-all duration-700">
                @php $hero1 = $featuredProducts->first(); @endphp
                @if($hero1)
                    <img src="{{ $hero1->image ? $hero1->image : 'https://upload.wikimedia.org/wikipedia/commons/6/64/Foods_%28cropped%29.jpg' }}" class="w-full h-full object-cover" alt="{{ $hero1->name }}">
                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                        <p class="text-white font-jakarta font-semibold text-sm truncate">{{ $hero1->name }}</p>
                        <p class="text-white/70 font-jakarta text-xs">Rp {{ number_format($hero1->selling_price, 0, ',', '.') }}</p>
                    </div>
                @else
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/64/Foods_%28cropped%29.jpg" class="w-full h-full object-cover" alt="Produk Segar">
                @endif
            </div>

            {{-- Secondary card --}}
            <div class="absolute z-10 w-[42%] max-w-[210px] aspect-square bg-white rounded-[2rem] shadow-xl shadow-black/8 overflow-hidden border border-black/5 transform -rotate-6 -translate-x-16 translate-y-14 hover:-rotate-4 hover:-translate-x-14 transition-all duration-700">
                @php $hero2 = $featuredProducts->skip(1)->first(); @endphp
                <img src="{{ $hero2 && $hero2->image ? $hero2->image : 'https://upload.wikimedia.org/wikipedia/commons/6/64/Foods_%28cropped%29.jpg' }}" class="w-full h-full object-cover grayscale-[20%]" alt="Sayuran Segar">
            </div>

            {{-- Floating badge --}}
            <div class="absolute z-30 top-6 left-4 bg-white rounded-2xl px-4 py-3 shadow-xl shadow-black/10 border border-black/5 flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                    <i class="ph ph-check-circle text-green-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-[11px] text-[#1a1a1a]/50 font-jakarta">Stok Tersedia</p>
                    <p class="text-[13px] font-jakarta font-semibold text-[#1a1a1a]">{{ $totalProducts }}+ Produk</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════
         SOCIAL PROOF STRIP (Warm & Light)
    ══════════════════════════════════════ --}}
    <section class="w-full border-y border-orange-100 bg-orange-50/50 py-8 mt-12 relative z-20">
        <div class="max-w-[1400px] mx-auto px-6 md:px-12 flex flex-col sm:flex-row items-center justify-between gap-8 sm:gap-4 text-center sm:text-left">
            <div class="gsap-stat flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0">
                    <i class="ph ph-users text-2xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-display font-semibold text-[#1a1a1a] mb-0.5">500+</p>
                    <p class="text-sm font-jakarta text-[#1a1a1a]/60">Pelanggan Aktif</p>
                </div>
            </div>
            <div class="gsap-stat flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">
                    <i class="ph ph-package text-2xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-display font-semibold text-[#1a1a1a] mb-0.5">{{ $totalProducts }}+</p>
                    <p class="text-sm font-jakarta text-[#1a1a1a]/60">Pilihan Produk</p>
                </div>
            </div>
            <div class="gsap-stat flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <i class="ph ph-truck text-2xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-display font-semibold text-[#1a1a1a] mb-0.5">Setiap Hari</p>
                    <p class="text-sm font-jakarta text-[#1a1a1a]/60">Pengiriman Aktif</p>
                </div>
            </div>
            <div class="gsap-stat flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center flex-shrink-0">
                    <i class="ph ph-star text-2xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-display font-semibold text-[#1a1a1a] mb-0.5">4.9/5</p>
                    <p class="text-sm font-jakarta text-[#1a1a1a]/60">Rating Pelanggan</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════
         CATEGORY VISUAL GRID
    ══════════════════════════════════════ --}}
    <section class="w-full max-w-[1400px] mx-auto px-6 md:px-12 py-20">
        <div class="flex items-end justify-between mb-10">
            <div>
                <h2 class="text-4xl font-display font-semibold text-[#1a1a1a] tracking-tight">Cari Berdasarkan<br>Kategori</h2>
            </div>
            <a href="{{ route('store.catalog') }}" class="text-[#1a1a1a]/50 hover:text-[#1a1a1a] font-jakarta font-medium text-sm transition-colors flex items-center gap-1">
                Semua Produk <i class="ph ph-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($categories as $cat)
            <a href="{{ route('store.catalog', ['category' => $cat]) }}" class="gsap-cat-card opacity-0 group relative overflow-hidden rounded-[1.5rem] bg-[#f5f4f0] aspect-[4/3] flex items-end shadow-sm hover:shadow-lg transition-all duration-500">
                <img
                    src="https://upload.wikimedia.org/wikipedia/commons/6/64/Foods_%28cropped%29.jpg"
                    alt="{{ $cat }}"
                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-80 group-hover:opacity-100"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                <div class="relative z-10 p-5 w-full">
                    <h3 class="text-white font-display font-semibold text-lg leading-tight">{{ $cat }}</h3>
                    <p class="text-white/60 font-jakarta text-xs mt-1 flex items-center gap-1">Lihat Produk <i class="ph ph-arrow-right text-[10px]"></i></p>
                </div>
            </a>
            @empty
            <p class="col-span-4 text-center text-[#1a1a1a]/40 font-jakarta py-8">Belum ada kategori.</p>
            @endforelse
        </div>
    </section>

    {{-- ══════════════════════════════════════
         PRODUK TERLARIS
    ══════════════════════════════════════ --}}
    <section class="w-full bg-[#f9f8f5] py-20">
        <div class="max-w-[1400px] mx-auto px-6 md:px-12">
            <div class="flex items-end justify-between mb-10">
                <div>
                    <h2 class="text-4xl font-display font-semibold text-[#1a1a1a] tracking-tight">Produk Terlaris</h2>
                    <p class="text-[#1a1a1a]/50 font-jakarta mt-2">Pilihan favorit dari pelanggan setia kami</p>
                </div>
                <a href="{{ route('store.catalog') }}" class="hidden sm:flex text-[#1a1a1a]/50 hover:text-[#1a1a1a] font-jakarta font-medium text-sm transition-colors items-center gap-1">
                    Lihat Semua <i class="ph ph-arrow-right"></i>
                </a>
            </div>

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl mb-8 font-jakarta text-center">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl mb-8 font-jakarta text-center">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @forelse($featuredProducts as $p)
                <div class="gsap-product-card opacity-0 group bg-white rounded-[1.5rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-1.5 border border-black/5 flex flex-col">
                    <a href="{{ route('store.show', $p->id) }}" class="relative aspect-[4/3] overflow-hidden bg-[#f5f4f0] block">
                        <img src="{{ $p->image ? $p->image : 'https://upload.wikimedia.org/wikipedia/commons/6/64/Foods_%28cropped%29.jpg' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $p->name }}">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors flex items-center justify-center">
                            <span class="bg-white text-[#1a1a1a] font-jakarta font-medium text-sm px-5 py-2 rounded-full opacity-0 group-hover:opacity-100 translate-y-3 group-hover:translate-y-0 transition-all duration-300 shadow-lg flex items-center gap-1.5">
                                <i class="ph ph-eye"></i> Detail
                            </span>
                        </div>
                    </a>
                    <div class="p-5 flex flex-col flex-grow">
                        <span class="text-[10px] uppercase tracking-widest text-[#1a1a1a]/40 font-semibold mb-1.5 font-jakarta">{{ $p->category }}</span>
                        <a href="{{ route('store.show', $p->id) }}" class="font-display font-semibold text-[#1a1a1a] text-lg leading-tight mb-auto hover:opacity-70 transition-opacity line-clamp-2">{{ $p->name }}</a>
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-black/5">
                            <span class="font-jakarta font-bold text-[#1a1a1a] text-lg">Rp {{ number_format($p->selling_price, 0, ',', '.') }}</span>
                            @auth
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-11 h-11 rounded-full bg-[#1a1a1a]/5 text-[#1a1a1a] hover:bg-[#1a1a1a] hover:text-white flex items-center justify-center transition-colors active:scale-90 duration-150">
                                        <i class="ph ph-shopping-bag text-lg"></i>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="w-11 h-11 rounded-full bg-[#1a1a1a]/5 text-[#1a1a1a] hover:bg-[#1a1a1a] hover:text-white flex items-center justify-center transition-colors active:scale-90 duration-150">
                                    <i class="ph ph-shopping-bag text-lg"></i>
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-4 text-center py-16 text-[#1a1a1a]/40 font-jakarta">Belum ada produk tersedia.</div>
                @endforelse
            </div>

            <div class="mt-12 flex justify-center sm:hidden">
                <a href="{{ route('store.catalog') }}" class="border border-[#1a1a1a]/10 text-[#1a1a1a] font-jakarta font-semibold px-8 py-4 rounded-full hover:bg-[#1a1a1a]/5 transition-colors">
                    Lihat Semua Produk <i class="ph ph-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════
         PROMO BANNER (HANGAT)
    ══════════════════════════════════════ --}}
    <section class="w-full max-w-[1400px] mx-auto px-6 md:px-12 py-20">
        <div class="gsap-promo opacity-0 relative rounded-[2rem] overflow-hidden h-[340px] md:h-[420px] flex items-center bg-[#f5f0e8] group">
            {{-- Background Image --}}
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/64/Foods_%28cropped%29.jpg" alt="Promo" class="absolute inset-0 w-full h-full object-cover opacity-20 group-hover:opacity-30 group-hover:scale-105 transition-all duration-1000">

            {{-- Content --}}
            <div class="relative z-10 px-10 md:px-16 max-w-2xl">
                <span class="inline-block bg-orange-100 text-orange-700 text-[11px] font-jakarta font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">Promo Akhir Pekan</span>
                <h2 class="text-4xl md:text-5xl font-display font-semibold text-[#1a1a1a] leading-tight mb-6">
                    Semua Kebutuhan Masak<br>Ada Di Sini.
                </h2>
                <a href="{{ route('store.catalog') }}" class="bg-[#1a1a1a] text-white font-jakarta font-semibold px-8 py-4 rounded-full hover:scale-105 active:scale-95 transition-transform inline-flex items-center gap-2 shadow-lg shadow-black/15">
                    Belanja Sekarang <i class="ph ph-arrow-right"></i>
                </a>
            </div>

            {{-- Decorative shape --}}
            <div class="absolute right-0 top-0 bottom-0 w-[40%] hidden md:flex items-center justify-center">
                <div class="w-[300px] h-[300px] rounded-full bg-orange-200/40 absolute"></div>
                <div class="w-[220px] h-[220px] rounded-full bg-orange-300/30 absolute translate-x-6 translate-y-6"></div>
                <i class="ph ph-chef-hat text-[160px] text-orange-300/50 relative z-10"></i>
            </div>
        </div>
    </section>

</main>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        gsap.registerPlugin(ScrollTrigger);

        const smoothEase = "expo.out"; // Memberikan efek berbobot dan smooth
        const heavyY = 80; // Jarak translate yang lebih jauh untuk efek mengayun

        // Set awal untuk mencegah kedipan
        gsap.set(["main section:first-child h1", "main section:first-child p", "main section:first-child .flex.flex-col.sm\\:flex-row", "main section:first-child .lg\\:w-\\[45\\%\\]", ".gsap-stat", ".gsap-cat-card", ".gsap-product-card", ".gsap-promo"], { willChange: "transform, opacity" });

        // 1. Hero Section (Masuk secara bergiliran dengan smooth)
        const tlHero = gsap.timeline({ defaults: { ease: smoothEase, force3D: true } });
        tlHero.fromTo("main section:first-child h1", 
            { y: heavyY, opacity: 0 }, 
            { y: 0, opacity: 1, duration: 2 }
        )
        .fromTo("main section:first-child p", 
            { y: 40, opacity: 0 }, 
            { y: 0, opacity: 1, duration: 1.8 }, "-=1.7"
        )
        .fromTo("main section:first-child .flex.flex-col.sm\\:flex-row", 
            { y: 40, opacity: 0 }, 
            { y: 0, opacity: 1, duration: 1.8 }, "-=1.6"
        )
        .fromTo("main section:first-child .lg\\:w-\\[45\\%\\]", 
            { y: 60, scale: 0.92, opacity: 0 }, 
            { y: 0, scale: 1, opacity: 1, duration: 2.2 }, "-=1.8"
        );

        // 2. Statistics Bar (Berbarengan beruntun)
        gsap.fromTo(".gsap-stat", 
            { y: 50, opacity: 0 }, 
            { 
                y: 0, opacity: 1, stagger: 0.1, duration: 1.5, ease: smoothEase, force3D: true,
                scrollTrigger: { trigger: ".gsap-stat", start: "top 95%", once: true }
            }
        );

        // 3. Category Grid (Lebih responsif, stagger cepat)
        gsap.fromTo(".gsap-cat-card", 
            { y: 60, opacity: 0 }, 
            { 
                y: 0, opacity: 1, stagger: 0.05, duration: 1.2, ease: smoothEase, force3D: true,
                scrollTrigger: { trigger: ".gsap-cat-card", start: "top 95%", once: true }
            }
        );

        // 4. Products Grid (Lebih responsif, stagger cepat)
        gsap.fromTo(".gsap-product-card", 
            { y: 60, opacity: 0 }, 
            { 
                y: 0, opacity: 1, stagger: 0.05, duration: 1.2, ease: smoothEase, force3D: true,
                scrollTrigger: { trigger: ".gsap-product-card", start: "top 95%", once: true }
            }
        );

        // 5. Promo Banner (Membesar sedikit saat masuk)
        gsap.fromTo(".gsap-promo", 
            { y: heavyY, scale: 0.95, opacity: 0 }, 
            { 
                y: 0, scale: 1, opacity: 1, duration: 2, ease: smoothEase, force3D: true,
                scrollTrigger: { trigger: ".gsap-promo", start: "top 85%", once: true }
            }
        );
    });
</script>
</x-storefront-layout>
