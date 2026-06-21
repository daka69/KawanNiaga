<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'KawanNiaga') }}</title>

        <!-- Tailwind & Alpine CDN -->
        <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Phosphor Icons -->
        <script src="https://unpkg.com/@phosphor-icons/web"></script>
        
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
        
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    </head>
    <body class="antialiased font-jakarta bg-[#FDFBF7] text-[#121212] min-h-screen flex items-center justify-center p-4 relative overflow-hidden selection:bg-[#121212] selection:text-[#FDFBF7]">
        
        <div class="noise-overlay"></div>

        <div class="w-full max-w-md relative z-10">
            <!-- Logo -->
            <div class="text-center mb-10">
                <a href="{{ route('store.index') }}" class="inline-block">
                    <h1 class="text-4xl font-display font-semibold text-[#121212] tracking-tight-display">KawanNiaga</h1>
                </a>
            </div>

            <!-- Card -->
            <div class="outer-shell shadow-sm motion-fluid hover:shadow-ambient">
                <div class="inner-core bg-white px-8 py-10">
                    {{ $slot }}
                </div>
            </div>
            
            <p class="mt-8 text-center text-xs font-semibold text-[#121212]/40 uppercase tracking-widest">© {{ date('Y') }} KawanNiaga. Segar Setiap Hari.</p>
        </div>
    </body>
</html>
