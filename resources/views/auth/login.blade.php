<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-2xl font-display font-semibold text-[#121212] mb-2 tracking-tight-display">Selamat Datang!</h2>
    <p class="text-[#121212]/60 text-sm mb-8 font-jakarta">Masuk ke akun Anda untuk mulai berbelanja.</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Alamat Email</label>
            <div class="flex items-center bg-[#fcfcfc] rounded-xl border border-[#121212]/10 px-4 py-3 focus-within:border-[#121212] focus-within:ring focus-within:ring-[#121212]/10 transition-all">
                <i class="ph ph-envelope-simple text-[#121212]/40 text-xl mr-3"></i>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                    class="w-full bg-transparent border-none focus:ring-0 text-[#121212] placeholder:text-[#121212]/30 p-0 font-jakarta" placeholder="nama@email.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Kata Sandi</label>
            <div class="flex items-center bg-[#fcfcfc] rounded-xl border border-[#121212]/10 px-4 py-3 focus-within:border-[#121212] focus-within:ring focus-within:ring-[#121212]/10 transition-all">
                <i class="ph ph-lock-key text-[#121212]/40 text-xl mr-3"></i>
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                    class="w-full bg-transparent border-none focus:ring-0 text-[#121212] placeholder:text-[#121212]/30 p-0 font-jakarta" placeholder="••••••••">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Remember Me & Forgot -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded border-[#121212]/20 text-[#121212] shadow-sm focus:ring-[#121212]/20 transition-colors" name="remember">
                <span class="ms-2 text-sm text-[#121212]/60 font-medium group-hover:text-[#121212] transition-colors">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-[#121212]/60 hover:text-[#121212] transition-colors" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-[#121212] hover:bg-black text-white font-semibold font-jakarta py-3.5 px-4 rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2 group">
                Masuk Sekarang
                <i class="ph ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>

        <div class="text-center mt-6 pt-6 border-t border-[#121212]/5">
            <p class="text-sm text-[#121212]/60 font-jakarta">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-[#121212] hover:underline">Daftar Sekarang</a></p>
        </div>
    </form>
</x-guest-layout>
