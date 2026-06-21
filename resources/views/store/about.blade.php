<x-storefront-layout>
<main class="flex-grow w-full max-w-[1400px] mx-auto px-6 md:px-12 pt-[140px] md:pt-[160px] pb-24">
    <!-- Header -->
    <div class="text-center mb-20 relative">
        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-[#121212]/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 opacity-50 pointer-events-none"></div>
        <h1 class="text-5xl md:text-6xl font-display font-semibold text-[#121212] mb-6 relative z-10 tracking-tight-display">KawanNiaga</h1>
        <p class="text-lg md:text-xl font-jakarta text-[#121212]/60 max-w-2xl mx-auto relative z-10 leading-relaxed">Menghadirkan kesegaran dan kelezatan bahan makanan premium langsung ke dapur Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-3">
            <div class="sticky top-[120px] outer-shell shadow-sm">
                <div class="inner-core bg-white p-6 flex flex-col gap-2">
                    <a href="#tentang" class="font-jakarta font-semibold text-[#121212] bg-[#121212]/5 px-5 py-3.5 rounded-xl transition-colors flex items-center gap-3">
                        <i class="ph ph-storefront text-xl"></i> Tentang Kami
                    </a>
                    <a href="#privasi" class="font-jakarta font-medium text-[#121212]/60 hover:text-[#121212] hover:bg-[#121212]/5 px-5 py-3.5 rounded-xl transition-colors flex items-center gap-3">
                        <i class="ph ph-shield-check text-xl"></i> Kebijakan Privasi
                    </a>
                    <a href="#kontak" class="font-jakarta font-medium text-[#121212]/60 hover:text-[#121212] hover:bg-[#121212]/5 px-5 py-3.5 rounded-xl transition-colors flex items-center gap-3">
                        <i class="ph ph-headset text-xl"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="lg:col-span-9 flex flex-col gap-12">
            <!-- Tentang Kami -->
            <section id="tentang" class="scroll-mt-[140px]">
                <div class="outer-shell shadow-sm">
                    <div class="inner-core bg-white p-8 md:p-12">
                        <h2 class="text-3xl md:text-4xl font-display font-semibold text-[#121212] mb-8 flex items-center gap-4 tracking-tight-display">
                            <i class="ph ph-storefront text-4xl text-[#121212]/40"></i> Tentang Kami
                        </h2>
                        <div class="space-y-6 text-[#121212]/70 font-jakarta leading-relaxed text-lg">
                            <p>Selamat datang di KawanNiaga. Kami mendefinisikan ulang cara Anda menikmati hidangan premium di rumah dengan kurasi produk makanan berkualitas tinggi.</p>
                            <p>Lahir dari komitmen untuk menghadirkan kepraktisan tanpa mengorbankan kualitas, KawanNiaga hadir sebagai mitra kuliner terpercaya bagi keluarga modern maupun pelaku usaha. Kami mengerti bahwa waktu Anda berharga, dan cita rasa adalah segalanya.</p>
                            <p>Visi kami adalah menciptakan ekosistem belanja yang mengutamakan kesegaran dan standar mutu terbaik. Melalui seleksi ketat dan pengelolaan modern, setiap produk kami jamin sampai ke tangan Anda dalam kondisi sempurna.</p>
                            <p class="font-semibold text-[#121212]">KawanNiaga — Praktis, lezat, dan selalu segar setiap hari.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Kebijakan Privasi -->
            <section id="privasi" class="scroll-mt-[140px]">
                <div class="outer-shell shadow-sm">
                    <div class="inner-core bg-white p-8 md:p-12">
                        <h2 class="text-3xl md:text-4xl font-display font-semibold text-[#121212] mb-8 flex items-center gap-4 tracking-tight-display">
                            <i class="ph ph-shield-check text-4xl text-[#121212]/40"></i> Kebijakan Privasi
                        </h2>
                        <div class="space-y-8 text-[#121212]/70 font-jakarta leading-relaxed text-lg">
                            <p>Privasi Anda sangat penting bagi KawanNiaga. Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda secara transparan.</p>
                            
                            <div class="bg-[#fcfcfc] p-6 rounded-2xl border border-[#121212]/5">
                                <h3 class="font-semibold text-[#121212] text-xl mb-3 flex items-center gap-2">
                                    <i class="ph ph-database text-[#121212]/40"></i> 1. Pengumpulan Informasi
                                </h3>
                                <p>Kami mengumpulkan informasi yang Anda berikan secara langsung saat mendaftar akun, melakukan transaksi, atau menghubungi layanan pelanggan kami. Ini termasuk namun tidak terbatas pada nama, alamat email, nomor telepon, dan alamat pengiriman.</p>
                            </div>
                            
                            <div class="bg-[#fcfcfc] p-6 rounded-2xl border border-[#121212]/5">
                                <h3 class="font-semibold text-[#121212] text-xl mb-3 flex items-center gap-2">
                                    <i class="ph ph-chart-bar text-[#121212]/40"></i> 2. Penggunaan Informasi
                                </h3>
                                <p>Informasi yang kami kumpulkan digunakan untuk memproses pesanan, mengatur pengiriman, dan memberikan pengalaman berbelanja yang dipersonalisasi. Kami juga menggunakannya untuk memberikan dukungan prioritas untuk Anda.</p>
                            </div>
                            
                            <div class="bg-[#fcfcfc] p-6 rounded-2xl border border-[#121212]/5">
                                <h3 class="font-semibold text-[#121212] text-xl mb-3 flex items-center gap-2">
                                    <i class="ph ph-lock-key text-[#121212]/40"></i> 3. Keamanan Data
                                </h3>
                                <p>Kami berinvestasi pada langkah-langkah keamanan teknis mutakhir untuk memastikan data pribadi Anda selalu terlindungi dari akses tidak sah. Semua transaksi pembayaran diproses dengan standar keamanan tinggi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Kontak -->
            <section id="kontak" class="scroll-mt-[140px]">
                <div class="outer-shell shadow-sm">
                    <div class="inner-core bg-white p-8 md:p-12">
                        <h2 class="text-3xl md:text-4xl font-display font-semibold text-[#121212] mb-8 flex items-center gap-4 tracking-tight-display">
                            <i class="ph ph-headset text-4xl text-[#121212]/40"></i> Hubungi Kami
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 font-jakarta">
                            <div class="flex flex-col gap-4 p-6 rounded-2xl bg-[#fcfcfc] border border-[#121212]/5 hover:border-[#121212]/20 transition-colors">
                                <div class="w-12 h-12 rounded-full bg-[#121212]/5 flex items-center justify-center text-[#121212]">
                                    <i class="ph ph-map-pin text-2xl"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#121212] mb-2 text-lg">Kantor Pusat</p>
                                    <p class="text-[#121212]/60 leading-relaxed">Jl. Sudirman No. 123,<br>Jakarta Selatan 12190</p>
                                </div>
                            </div>
                            <div class="flex flex-col gap-4 p-6 rounded-2xl bg-[#fcfcfc] border border-[#121212]/5 hover:border-[#121212]/20 transition-colors">
                                <div class="w-12 h-12 rounded-full bg-[#121212]/5 flex items-center justify-center text-[#121212]">
                                    <i class="ph ph-envelope-simple text-2xl"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#121212] mb-2 text-lg">Email</p>
                                    <p class="text-[#121212]/60 leading-relaxed">cs@kawanniaga.com<br>info@kawanniaga.com</p>
                                </div>
                            </div>
                            <div class="flex flex-col gap-4 p-6 rounded-2xl bg-[#fcfcfc] border border-[#121212]/5 hover:border-[#121212]/20 transition-colors">
                                <div class="w-12 h-12 rounded-full bg-[#121212]/5 flex items-center justify-center text-[#121212]">
                                    <i class="ph ph-phone text-2xl"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-[#121212] mb-2 text-lg">Hotline</p>
                                    <p class="text-[#121212]/60 leading-relaxed">(021) 123-4567<br>WA: 0812-3456-7890</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
<script>
    // Smooth scrolling & active state for sidebar
    document.addEventListener('DOMContentLoaded', () => {
        const links = document.querySelectorAll('.sticky a');
        
        const updateActiveLink = () => {
            let currentId = '';
            document.querySelectorAll('section').forEach(section => {
                const sectionTop = section.offsetTop;
                if (window.scrollY >= sectionTop - 200) {
                    currentId = section.getAttribute('id');
                }
            });

            links.forEach(link => {
                link.className = 'font-jakarta font-medium text-[#121212]/60 hover:text-[#121212] hover:bg-[#121212]/5 px-5 py-3.5 rounded-xl transition-colors flex items-center gap-3';
                if (link.getAttribute('href') === `#${currentId}`) {
                    link.className = 'font-jakarta font-semibold text-[#121212] bg-[#121212]/5 px-5 py-3.5 rounded-xl transition-colors flex items-center gap-3';
                }
            });
        };

        window.addEventListener('scroll', updateActiveLink);
    });
</script>
</x-storefront-layout>
