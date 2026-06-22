<!DOCTYPE html>
<html lang="id" style="">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Kawan Niaga') }} - Sajian Praktis, Lezat, & Segar</title>
    
    <!-- Tailwind & Alpine CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- GSAP & ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "fontFamily": {
                        "headline-md": ["Clash Display", "sans-serif"],
                        "body-lg": ["Plus Jakarta Sans", "sans-serif"],
                        "display-lg-mobile": ["Clash Display", "sans-serif"],
                        "body-md": ["Plus Jakarta Sans", "sans-serif"],
                        "label-bold": ["Plus Jakarta Sans", "sans-serif"],
                        "display-lg": ["Clash Display", "sans-serif"],
                        "jakarta": ["Plus Jakarta Sans", "sans-serif"],
                        "display": ["Clash Display", "sans-serif"]
                    }
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        .ambient-shadow { box-shadow: 0px 40px 100px rgba(0, 0, 0, 0.03), 0px 10px 40px rgba(0, 0, 0, 0.02); }
        .hover-lift { transition: transform 0.5s cubic-bezier(0.32, 0.72, 0, 1), box-shadow 0.5s cubic-bezier(0.32, 0.72, 0, 1); }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0px 50px 120px rgba(0, 0, 0, 0.05), 0px 15px 45px rgba(0, 0, 0, 0.03); }
        .wave-divider {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }
        .wave-divider svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 60px;
        }
        .wave-divider .shape-fill { fill: #FDFBF7; }
        .float-animation { animation: float 8s ease-in-out infinite; }
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(2deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
    </style>
</head>
<body class="bg-[#FDFBF7] text-[#121212] font-jakarta min-h-screen flex flex-col relative overflow-x-hidden selection:bg-[#121212] selection:text-[#FDFBF7]">
    <div class="noise-overlay"></div>
    
    <!-- Fluid Island Nav -->
    <header x-data="{ mobileMenuOpen: false, scrolled: false }" 
            @scroll.window="scrolled = (window.pageYOffset > 20)"
            :class="scrolled ? 'top-4 py-3 shadow-ambient' : 'top-8 py-5'"
            class="fixed left-0 right-0 z-50 mx-auto w-[95%] max-w-[1200px] flex justify-between items-center px-8 outer-shell bg-[#ffffff]/70 backdrop-blur-2xl motion-fluid">
        
        <div class="flex items-center gap-4">
            <a href="{{ route('store.index') }}" class="flex items-center gap-2">
                <span class="text-2xl font-display font-semibold text-[#121212] tracking-tight-display">KawanNiaga</span>
            </a>
        </div>
        
        <!-- Search Bar -->
        <form action="{{ route('store.catalog') }}" method="GET" class="hidden md:flex items-center inner-core px-4 py-2 flex-grow max-w-md mx-8 transition-colors border border-transparent focus-within:border-[#121212]/20">
            <i class="ph ph-magnifying-glass text-[#121212]/50 text-xl"></i>
            <input name="search" value="{{ request('search') }}" class="bg-transparent border-none focus:ring-0 w-full text-sm font-jakarta text-[#121212] outline-none px-3 placeholder:text-[#121212]/40" placeholder="Cari produk lezat..." type="text">
        </form>
        
        <div class="flex items-center gap-6">
            <nav class="hidden lg:flex gap-6">
                <div class="hidden md:flex gap-8 items-center font-jakarta font-medium text-[15px] text-[#121212]/70">
                    <a class="hover:text-[#121212] transition-colors" href="{{ route('store.index') }}">Beranda</a>
                    <a class="hover:text-[#121212] transition-colors" href="{{ route('store.catalog') }}">Katalog</a>
                    @auth
                        @if(Auth::user()->role === 'pembeli')
                            <a class="hover:text-[#121212] transition-colors" href="{{ route('orders.index') }}">Pesanan Saya</a>
                        @endif
                    @endauth
                </div>
            </nav>
            <div class="flex items-center gap-4">
                @if(auth()->check() && auth()->user()->role === 'pembeli')
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-[#121212] hover:bg-[#121212]/5 rounded-full transition-colors active:scale-95 duration-150 ease-in-out group">
                        <i class="ph ph-shopping-cart text-2xl group-hover:scale-110 transition-transform"></i>
                        @php $cartCount = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0; @endphp
                        @if($cartCount > 0)
                        <span class="absolute top-0 right-0 bg-[#121212] text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">{{ $cartCount }}</span>
                        @endif
                    </a>
                @elseif(!auth()->check())
                    <a href="{{ route('login') }}" class="relative p-2 text-[#121212] hover:bg-[#121212]/5 rounded-full transition-colors active:scale-95 duration-150 ease-in-out group">
                        <i class="ph ph-shopping-cart text-2xl group-hover:scale-110 transition-transform"></i>
                    </a>
                @endif
                
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-[#121212]/70 hover:text-[#121212] transition-colors p-2 rounded-full hover:bg-[#121212]/5">
                                <span class="font-jakarta font-medium text-[15px] mr-2 hidden md:block">{{ Auth::user()->name }}</span>
                                <i class="ph ph-user-circle text-2xl"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="font-jakarta">
                                {{ __('Profil Saya') }}
                            </x-dropdown-link>
                            @if(Auth::user()->role === 'pembeli')
                                <x-dropdown-link :href="route('orders.index')" class="font-jakarta">
                                    {{ __('Pesanan Saya') }}
                                </x-dropdown-link>
                            @endif
                            @if(Auth::user()->role === 'penjual')
                                <x-dropdown-link :href="route('dashboard')" class="font-jakarta">
                                    {{ __('Dashboard Penjual') }}
                                </x-dropdown-link>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="font-jakarta text-red-600"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Keluar') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="bg-[#121212] text-white px-6 py-2.5 rounded-full font-jakarta font-medium text-[15px] hover:bg-black transition-transform hover:scale-105 active:scale-95 duration-150 ease-in-out shadow-sm">
                        Masuk
                    </a>
                @endauth

                <!-- Hamburger Mobile -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-[#121212] hover:bg-[#121212]/5 rounded-full transition-colors relative w-10 h-10 flex items-center justify-center">
                    <div class="flex flex-col justify-between w-5 h-4 transform transition-all duration-300 origin-center" :class="mobileMenuOpen ? 'rotate-180' : ''">
                        <div class="h-0.5 w-5 bg-current transform transition-all duration-300 origin-left" :class="mobileMenuOpen ? 'rotate-[42deg] w-6' : ''"></div>
                        <div class="h-0.5 w-5 bg-current transform transition-all duration-300" :class="mobileMenuOpen ? 'opacity-0 translate-x-2' : ''"></div>
                        <div class="h-0.5 w-5 bg-current transform transition-all duration-300 origin-left" :class="mobileMenuOpen ? '-rotate-[42deg] w-6' : ''"></div>
                    </div>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 translate-y-4 blur-sm" 
             x-transition:enter-end="opacity-100 translate-y-0 blur-0" 
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0 blur-0" 
             x-transition:leave-end="opacity-0 translate-y-4 blur-sm" 
             @click.outside="mobileMenuOpen = false" 
             class="absolute top-full left-0 right-0 mt-4 w-full outer-shell bg-[#ffffff]/90 backdrop-blur-3xl shadow-ambient lg:hidden" style="display: none;">
            <div class="p-6 flex flex-col gap-2 font-jakarta">
                <!-- Mobile Search -->
                <form action="{{ route('store.catalog') }}" method="GET" class="flex items-center inner-core px-4 py-3 mb-4">
                    <i class="ph ph-magnifying-glass text-[#121212]/50 text-xl mr-2"></i>
                    <input name="search" value="{{ request('search') }}" class="bg-transparent border-none focus:ring-0 w-full text-sm font-jakarta text-[#121212] outline-none placeholder:text-[#121212]/40" placeholder="Cari produk..." type="text">
                </form>
                <a class="text-[#121212]/70 font-semibold py-3 px-4 rounded-xl hover:bg-[#121212]/5 hover:text-[#121212] transition-colors" href="{{ route('store.index') }}">Beranda</a>
                <a class="text-[#121212]/70 font-semibold py-3 px-4 rounded-xl hover:bg-[#121212]/5 hover:text-[#121212] transition-colors" href="{{ route('store.catalog') }}">Katalog</a>
                @auth
                    <a class="text-[#121212]/70 font-semibold py-3 px-4 rounded-xl hover:bg-[#121212]/5 hover:text-[#121212] transition-colors" href="{{ route('profile.edit') }}">Profil Saya</a>
                    @if(Auth::user()->role === 'pembeli')
                        <a class="text-[#121212]/70 font-semibold py-3 px-4 rounded-xl hover:bg-[#121212]/5 hover:text-[#121212] transition-colors" href="{{ route('orders.index') }}">Pesanan Saya</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left text-red-600 font-semibold py-3 px-4 rounded-xl hover:bg-red-50 transition-colors">Keluar</button>
                    </form>
                @else
                    <a class="text-center bg-[#121212] text-white py-3 px-4 rounded-full font-semibold mt-2 shadow-sm" href="{{ route('login') }}">Masuk</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    {{ $slot }}

    <!-- Footer -->
    <footer class="w-full py-16 px-6 md:px-12 flex flex-col md:flex-row justify-between items-center gap-8 bg-transparent mt-auto border-t border-[#121212]/5 relative z-10 max-w-[1400px] mx-auto">
        <div class="flex flex-col items-center md:items-start gap-4">
            <span class="text-3xl font-display font-semibold text-[#121212] tracking-tight-display">KawanNiaga</span>
            <p class="text-[15px] font-jakarta text-[#121212]/60">
                © {{ date('Y') }} KawanNiaga. Segar Setiap Hari.
            </p>
        </div>
        <nav class="flex flex-wrap justify-center gap-6 font-jakarta">
            <a class="text-[#121212]/60 font-semibold hover:text-[#121212] transition-colors" href="{{ route('about') }}">Tentang Kami</a>
            <a class="text-[#121212]/60 font-semibold hover:text-[#121212] transition-colors" href="{{ route('about') }}#privasi">Kebijakan Privasi</a>
            <a class="text-[#121212]/60 font-semibold hover:text-[#121212] transition-colors" href="{{ route('about') }}#kontak">Hubungi Kami</a>
        </nav>
    </footer>
</body>
</html>
