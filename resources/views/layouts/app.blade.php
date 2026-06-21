<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Kawan Niaga') }} - Admin Dashboard</title>

        <!-- Tailwind & Alpine CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Phosphor Icons -->
        <script src="https://unpkg.com/@phosphor-icons/web"></script>
        
        <!-- Material Symbols -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
        
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            'sans': ['Plus Jakarta Sans', 'sans-serif'],
                            'display': ['Clash Display', 'sans-serif'],
                            'jakarta': ['Plus Jakarta Sans', 'sans-serif']
                        }
                    }
                }
            }
        </script>

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <style>
            .hover-lift { transition: transform 0.5s cubic-bezier(0.32, 0.72, 0, 1), box-shadow 0.5s cubic-bezier(0.32, 0.72, 0, 1); }
            .hover-lift:hover { transform: translateY(-5px); box-shadow: 0px 50px 120px rgba(0, 0, 0, 0.05), 0px 15px 45px rgba(0, 0, 0, 0.03); }
        </style>
    </head>
    <body class="antialiased font-jakarta bg-[#FDFBF7] text-[#121212] selection:bg-[#121212] selection:text-[#FDFBF7] min-h-screen flex flex-col relative">
        <div class="noise-overlay"></div>
        
        @include('layouts.navigation')

        <!-- Page Heading (With PT to clear fixed nav) -->
        @isset($header)
            <header class="bg-transparent border-b border-[#121212]/5 relative z-20 pt-[120px] pb-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @else
            <!-- Spacer if no header -->
            <div class="pt-[120px]"></div>
        @endisset

        <!-- Page Content -->
        <main class="relative z-10 flex-1 py-8 w-full max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="w-full py-12 px-6 md:px-16 flex flex-col md:flex-row justify-between items-center gap-8 bg-transparent mt-auto border-t border-[#121212]/5 relative z-10">
            <div class="flex flex-col items-center md:items-start gap-4">
                <span class="text-2xl font-display font-semibold text-[#121212] tracking-tight-display">KawanNiaga</span>
                <p class="text-sm font-jakarta text-[#121212]/60">
                    © {{ date('Y') }} KawanNiaga. Dashboard Operasional.
                </p>
            </div>
            <nav class="flex flex-wrap justify-center gap-6">
                <a class="text-[#121212]/60 text-sm font-semibold hover:text-[#121212] transition-colors" href="{{ route('store.index') }}">Lihat Katalog Utama</a>
            </nav>
        </footer>
    </body>
</html>
