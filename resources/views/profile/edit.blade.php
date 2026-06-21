<x-storefront-layout>
<main class="flex-grow w-full max-w-[1400px] mx-auto px-6 md:px-12 pt-[140px] md:pt-[160px] pb-24">
    <!-- Flash Messages -->
    @if(session('status') === 'profile-updated')
        <div class="outer-shell mb-8 motion-fluid">
            <div class="inner-core bg-[#121212] text-white p-4 flex items-center gap-3">
                <i class="ph ph-check-circle text-xl text-green-400"></i>
                <span class="font-jakarta font-medium">Profil berhasil diperbarui.</span>
            </div>
        </div>
    @endif
    @if($errors->any())
        <div class="outer-shell mb-8 motion-fluid">
            <div class="inner-core bg-red-50 border border-red-100 text-red-700 p-4 flex items-start gap-3">
                <i class="ph ph-warning-circle text-xl mt-0.5"></i>
                <div class="flex flex-col font-jakarta">
                    <span class="font-semibold mb-1">Terdapat kesalahan pada isian Anda:</span>
                    <ul class="list-disc ml-5 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="mb-12 text-center md:text-left">
        <h1 class="text-4xl md:text-5xl font-display font-semibold text-[#121212] tracking-tight-display mb-2">Profil Saya</h1>
        <p class="font-jakarta text-lg text-[#121212]/60">Kelola informasi pribadi dan pengaturan akun Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Avatar & Quick Info Sidebar -->
        <div class="lg:col-span-4 flex flex-col gap-6">
            <div class="outer-shell">
                <div class="inner-core bg-white p-8 flex flex-col items-center text-center">
                    <div class="relative w-32 h-32 mb-6">
                        <!-- Default Avatar using Ui-Avatars -->
                        <img alt="User Avatar" class="w-full h-full object-cover rounded-[2rem] bg-[#121212]/5 p-2 shadow-sm" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=121212&color=ffffff&size=128"/>
                    </div>
                    <h2 class="font-display font-semibold text-2xl text-[#121212] mb-1">{{ $user->name }}</h2>
                    <p class="font-jakarta text-[#121212]/60 text-sm">Member sejak {{ $user->created_at->format('Y') }}</p>
                    <div class="mt-8 w-full bg-[#121212]/5 rounded-2xl p-4 border border-[#121212]/10">
                        <div class="flex items-center justify-center gap-3 text-[#121212]">
                            <i class="ph ph-star text-xl" style="font-variation-settings: 'FILL' 1;"></i>
                            <span class="font-jakarta font-semibold text-sm">KawanNiaga Member</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Info Form -->
        <div class="lg:col-span-8 flex flex-col gap-8">
            <!-- Personal Info Card -->
            <div class="outer-shell" x-data="{ isEditing: false }">
                <div class="inner-core bg-white p-8 md:p-10">
                    <div class="flex justify-between items-center mb-8 border-b border-[#121212]/10 pb-4">
                        <h3 class="font-display font-semibold text-2xl text-[#121212] flex items-center gap-3 tracking-tight-display">
                            <i class="ph ph-user text-[#121212]/50"></i> Informasi Pribadi
                        </h3>
                    </div>
                    
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 gap-6 font-jakarta">
                            <!-- Field: Nama -->
                            <div class="group">
                                <label class="block font-semibold text-[#121212]/70 text-sm mb-2">Nama Lengkap</label>
                                <div :class="isEditing ? 'border-[#121212] ring-2 ring-[#121212]/10' : 'border-[#121212]/10'" class="flex items-center bg-[#fcfcfc] rounded-xl border p-2 transition-all duration-300">
                                    <input name="name" :readonly="!isEditing" class="w-full bg-transparent border-none focus:ring-0 font-medium text-[#121212] px-4 py-2" type="text" value="{{ old('name', $user->name) }}" required/>
                                    <button type="button" @click="isEditing = true" aria-label="Edit Nama" x-show="!isEditing" class="text-[#121212]/40 hover:text-[#121212] p-2 rounded-full transition-colors opacity-0 group-hover:opacity-100">
                                        <i class="ph ph-pencil-simple text-xl"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Field: Email -->
                            <div class="group">
                                <label class="block font-semibold text-[#121212]/70 text-sm mb-2">Alamat Email</label>
                                <div :class="isEditing ? 'border-[#121212] ring-2 ring-[#121212]/10' : 'border-[#121212]/10'" class="flex items-center bg-[#fcfcfc] rounded-xl border p-2 transition-all duration-300">
                                    <input name="email" :readonly="!isEditing" class="w-full bg-transparent border-none focus:ring-0 font-medium text-[#121212] px-4 py-2" type="email" value="{{ old('email', $user->email) }}" required/>
                                    <button type="button" @click="isEditing = true" aria-label="Edit Email" x-show="!isEditing" class="text-[#121212]/40 hover:text-[#121212] p-2 rounded-full transition-colors opacity-0 group-hover:opacity-100">
                                        <i class="ph ph-pencil-simple text-xl"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Field: No Telp -->
                            <div class="group">
                                <label class="block font-semibold text-[#121212]/70 text-sm mb-2">Nomor Telepon</label>
                                <div :class="isEditing ? 'border-[#121212] ring-2 ring-[#121212]/10' : 'border-[#121212]/10'" class="flex items-center bg-[#fcfcfc] rounded-xl border p-2 transition-all duration-300">
                                    <input name="phone" :readonly="!isEditing" class="w-full bg-transparent border-none focus:ring-0 font-medium text-[#121212] px-4 py-2 placeholder:text-[#121212]/30" type="tel" value="{{ old('phone', $user->phone) }}" placeholder="Belum ada nomor telepon"/>
                                    <button type="button" @click="isEditing = true" aria-label="Edit Telepon" x-show="!isEditing" class="text-[#121212]/40 hover:text-[#121212] p-2 rounded-full transition-colors opacity-0 group-hover:opacity-100">
                                        <i class="ph ph-pencil-simple text-xl"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Field: Alamat -->
                            <div class="group">
                                <label class="block font-semibold text-[#121212]/70 text-sm mb-2">Alamat Pengiriman Utama</label>
                                <div :class="isEditing ? 'border-[#121212] ring-2 ring-[#121212]/10' : 'border-[#121212]/10'" class="flex items-start bg-[#fcfcfc] rounded-2xl border p-2 transition-all duration-300">
                                    <textarea name="address" :readonly="!isEditing" class="w-full bg-transparent border-none focus:ring-0 font-medium text-[#121212] px-4 py-2 resize-none placeholder:text-[#121212]/30" rows="3" placeholder="Belum ada alamat">{{ old('address', $user->address) }}</textarea>
                                    <button type="button" @click="isEditing = true" aria-label="Edit Alamat" x-show="!isEditing" class="text-[#121212]/40 hover:text-[#121212] p-2 mt-2 rounded-full transition-colors opacity-0 group-hover:opacity-100">
                                        <i class="ph ph-pencil-simple text-xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-8 flex flex-col sm:flex-row justify-end gap-4" x-show="isEditing" x-transition.opacity>
                            <button type="button" @click="isEditing = false; $el.closest('form').reset()" class="px-6 py-3 font-jakarta font-semibold text-[#121212]/60 bg-[#121212]/5 hover:bg-[#121212]/10 rounded-full transition-colors">Batal</button>
                            <button type="submit" class="px-8 py-3 font-jakarta font-semibold text-white bg-[#121212] hover:bg-black rounded-full shadow-sm transition-colors flex items-center justify-center gap-2 active:scale-95 duration-150">
                                <i class="ph ph-floppy-disk text-lg"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Danger Zone -->
            <div x-data="{ showDeleteModal: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }} }" class="outer-shell mt-4">
                <div class="inner-core bg-red-50/50 border border-red-100 p-8 md:p-10">
                    <h3 class="font-display font-semibold text-2xl text-red-600 flex items-center gap-3 mb-4 tracking-tight-display">
                        <i class="ph ph-warning"></i> Zona Bahaya
                    </h3>
                    <p class="font-jakarta text-[#121212]/70 mb-8 leading-relaxed">
                        Tindakan di area ini bersifat permanen. Jika Anda menghapus akun, semua data riwayat pesanan, resep favorit, dan informasi lainnya akan hilang selamanya dan tidak dapat dipulihkan.
                    </p>
                    <button @click="showDeleteModal = true" class="flex items-center gap-2 bg-white border border-red-200 text-red-600 hover:bg-red-600 hover:text-white font-jakarta font-semibold py-3 px-6 rounded-full transition-all duration-300 shadow-sm">
                        <i class="ph ph-trash text-lg"></i>
                        Hapus Akun Saya
                    </button>

                    <!-- Delete Modal -->
                    <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div x-show="showDeleteModal" x-transition.opacity class="fixed inset-0 bg-[#121212]/50 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="showDeleteModal = false"></div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                            
                            <!-- Modal Panel -->
                            <div x-show="showDeleteModal" x-transition.scale class="inline-block align-bottom outer-shell text-left overflow-hidden transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="inner-core bg-white p-8">
                                    <form method="post" action="{{ route('profile.destroy') }}">
                                        @csrf
                                        @method('delete')
                                        
                                        <h2 class="font-display font-semibold text-2xl text-[#121212] mb-3" id="modal-title">Apakah Anda yakin?</h2>
                                        <p class="font-jakarta text-sm text-[#121212]/60 mb-6 leading-relaxed">
                                            Sekali dihapus, semua data profil dan pesanan Anda tidak bisa dikembalikan. Silakan masukkan password Anda untuk konfirmasi penghapusan.
                                        </p>
                                        
                                        <div class="mb-8 font-jakarta">
                                            <div class="flex items-center bg-[#fcfcfc] rounded-xl border border-[#121212]/10 px-4 py-3 focus-within:border-[#121212] focus-within:ring focus-within:ring-[#121212]/10 transition-all">
                                                <i class="ph ph-lock-key text-[#121212]/40 text-xl mr-3"></i>
                                                <input type="password" name="password" id="password" class="w-full bg-transparent border-none focus:ring-0 text-[#121212] placeholder:text-[#121212]/30 p-0 text-sm" placeholder="Masukkan Password Anda" required>
                                            </div>
                                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-500 text-sm" />
                                        </div>
                                        
                                        <div class="flex flex-col sm:flex-row justify-end gap-3">
                                            <button type="button" @click="showDeleteModal = false" class="px-6 py-3 font-jakarta font-semibold text-[#121212]/60 bg-[#121212]/5 hover:bg-[#121212]/10 rounded-full transition-colors w-full sm:w-auto">Batal</button>
                                            <button type="submit" class="px-6 py-3 font-jakarta font-semibold text-white bg-red-600 hover:bg-red-700 rounded-full shadow-sm transition-colors flex items-center justify-center gap-2 w-full sm:w-auto">
                                                Hapus Akun
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</x-storefront-layout>
