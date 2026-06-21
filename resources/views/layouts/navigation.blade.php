@php
    $isPenjual = auth()->check() && auth()->user()->role === 'penjual';
@endphp

<nav x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="scrolled ? 'top-4 py-3 shadow-ambient' : 'top-8 py-4'"
     class="fixed left-0 right-0 z-50 mx-auto w-[95%] max-w-[1200px] flex justify-between items-center px-6 outer-shell bg-[#ffffff]/70 backdrop-blur-2xl motion-fluid font-jakarta">
     
    <!-- Primary Navigation Menu -->
    <div class="flex items-center gap-8 w-full justify-between">
        <div class="flex items-center">
            <!-- Logo -->
            <a href="{{ $isPenjual ? route('dashboard') : route('store.index') }}" class="flex items-center gap-2 mr-8">
                <span class="text-2xl font-display font-semibold text-[#121212] tracking-tight-display hidden sm:block">KawanNiaga</span>
                <span class="text-xl font-display font-semibold text-[#121212] tracking-tight-display sm:hidden">KN</span>
            </a>

            <!-- Navigation Links -->
            <div class="hidden sm:flex items-center gap-2">
                @if($isPenjual)
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#121212] text-white' : 'text-[#121212]/60 hover:bg-[#121212]/5 hover:text-[#121212]' }}">
                        <i class="ph ph-squares-four mr-1"></i> Dashboard
                    </a>
                    <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('products.*') ? 'bg-[#121212] text-white' : 'text-[#121212]/60 hover:bg-[#121212]/5 hover:text-[#121212]' }}">
                        <i class="ph ph-package mr-1"></i> SKU
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-[#121212] text-white' : 'text-[#121212]/60 hover:bg-[#121212]/5 hover:text-[#121212]' }}">
                        <i class="ph ph-receipt mr-1"></i> Pesanan
                    </a>
                    <a href="{{ route('store.index') }}" target="_blank" class="px-4 py-2 rounded-xl text-sm font-medium text-[#121212]/60 hover:bg-[#121212]/5 hover:text-[#121212] transition-colors ml-4 border border-[#121212]/10">
                        <i class="ph ph-storefront mr-1"></i> Lihat Toko
                    </a>
                @else
                    <a href="{{ route('store.index') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('store.*') ? 'bg-[#121212] text-white' : 'text-[#121212]/60 hover:bg-[#121212]/5 hover:text-[#121212]' }}">
                        <i class="ph ph-storefront mr-1"></i> Katalog
                    </a>
                @endif
            </div>
        </div>

        <!-- Settings Dropdown -->
        <div class="hidden sm:flex sm:items-center">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-[#121212]/70 hover:text-[#121212] transition-colors p-2 rounded-full hover:bg-[#121212]/5">
                        <span class="font-jakarta font-medium text-[15px] mr-2">{{ Auth::user()->name }}</span>
                        <i class="ph ph-user-circle text-2xl"></i>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 font-medium font-jakarta">
                            <i class="ph ph-sign-out mr-1"></i> {{ __('Keluar') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

        <!-- Hamburger -->
        <div class="flex items-center sm:hidden">
            <button @click="open = ! open" class="p-2 text-[#121212] hover:bg-[#121212]/5 rounded-full transition-colors relative w-10 h-10 flex items-center justify-center">
                <div class="flex flex-col justify-between w-5 h-4 transform transition-all duration-300 origin-center" :class="open ? 'rotate-180' : ''">
                    <div class="h-0.5 w-5 bg-current transform transition-all duration-300 origin-left" :class="open ? 'rotate-[42deg] w-6' : ''"></div>
                    <div class="h-0.5 w-5 bg-current transform transition-all duration-300" :class="open ? 'opacity-0 translate-x-2' : ''"></div>
                    <div class="h-0.5 w-5 bg-current transform transition-all duration-300 origin-left" :class="open ? '-rotate-[42deg] w-6' : ''"></div>
                </div>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu Dropdown -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0 translate-y-4 blur-sm" 
         x-transition:enter-end="opacity-100 translate-y-0 blur-0" 
         x-transition:leave="transition ease-in duration-200" 
         x-transition:leave-start="opacity-100 translate-y-0 blur-0" 
         x-transition:leave-end="opacity-0 translate-y-4 blur-sm" 
         @click.outside="open = false"
         class="absolute top-full left-0 right-0 mt-4 w-full outer-shell bg-[#ffffff]/95 backdrop-blur-3xl shadow-ambient sm:hidden" style="display: none;">
         
        <div class="p-4 flex flex-col gap-2">
            @if($isPenjual)
                <a href="{{ route('dashboard') }}" class="px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#121212] text-white' : 'text-[#121212] hover:bg-[#121212]/5' }}">
                    Dashboard Admin
                </a>
                <a href="{{ route('products.index') }}" class="px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('products.*') ? 'bg-[#121212] text-white' : 'text-[#121212] hover:bg-[#121212]/5' }}">
                    Kelola SKU
                </a>
                <a href="{{ route('admin.orders.index') }}" class="px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-[#121212] text-white' : 'text-[#121212] hover:bg-[#121212]/5' }}">
                    Kelola Pesanan
                </a>
                <a href="{{ route('store.index') }}" class="px-4 py-3 rounded-xl text-sm font-medium text-[#121212] border border-[#121212]/10 mt-2">
                    Lihat Toko
                </a>
            @else
                <a href="{{ route('store.index') }}" class="px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('store.*') ? 'bg-[#121212] text-white' : 'text-[#121212] hover:bg-[#121212]/5' }}">
                    Katalog
                </a>
            @endif
            
            <div class="border-t border-[#121212]/10 mt-2 pt-2">
                <div class="px-4 py-2">
                    <div class="font-semibold text-[#121212]">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-[#121212]/60">{{ Auth::user()->email }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
