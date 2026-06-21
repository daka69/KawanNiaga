<x-guest-layout>
    <h2 class="text-2xl font-display font-semibold text-[#121212] mb-2 tracking-tight-display">Buat Akun Baru</h2>
    <p class="text-[#121212]/60 text-sm mb-8 font-jakarta">Daftar sebagai pembeli dan mulai belanja produk segar.</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Nama Lengkap</label>
            <div class="flex items-center bg-[#fcfcfc] rounded-xl border border-[#121212]/10 px-4 py-3 focus-within:border-[#121212] focus-within:ring focus-within:ring-[#121212]/10 transition-all">
                <i class="ph ph-user text-[#121212]/40 text-xl mr-3"></i>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                    class="w-full bg-transparent border-none focus:ring-0 text-[#121212] placeholder:text-[#121212]/30 p-0 font-jakarta" placeholder="Masukkan nama lengkap">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Alamat Email</label>
            <div class="flex items-center bg-[#fcfcfc] rounded-xl border border-[#121212]/10 px-4 py-3 focus-within:border-[#121212] focus-within:ring focus-within:ring-[#121212]/10 transition-all">
                <i class="ph ph-envelope-simple text-[#121212]/40 text-xl mr-3"></i>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                    class="w-full bg-transparent border-none focus:ring-0 text-[#121212] placeholder:text-[#121212]/30 p-0 font-jakarta" placeholder="nama@email.com">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Kata Sandi</label>
            <div class="flex items-center bg-[#fcfcfc] rounded-xl border border-[#121212]/10 px-4 py-3 focus-within:border-[#121212] focus-within:ring focus-within:ring-[#121212]/10 transition-all">
                <i class="ph ph-lock-key text-[#121212]/40 text-xl mr-3"></i>
                <input id="password" type="password" name="password" required autocomplete="new-password" 
                    class="w-full bg-transparent border-none focus:ring-0 text-[#121212] placeholder:text-[#121212]/30 p-0 font-jakarta" placeholder="Minimal 8 karakter">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Konfirmasi Kata Sandi</label>
            <div class="flex items-center bg-[#fcfcfc] rounded-xl border border-[#121212]/10 px-4 py-3 focus-within:border-[#121212] focus-within:ring focus-within:ring-[#121212]/10 transition-all">
                <i class="ph ph-lock-key text-[#121212]/40 text-xl mr-3"></i>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                    class="w-full bg-transparent border-none focus:ring-0 text-[#121212] placeholder:text-[#121212]/30 p-0 font-jakarta" placeholder="Ulangi kata sandi">
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-[#121212] hover:bg-black text-white font-semibold font-jakarta py-3.5 px-4 rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2 group">
                Daftar Sekarang
                <i class="ph ph-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>

        <div class="text-center mt-6 pt-6 border-t border-[#121212]/5">
            <p class="text-sm text-[#121212]/60 font-jakarta">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-[#121212] hover:underline">Masuk di sini</a></p>
        </div>
    </form>
</x-guest-layout>
