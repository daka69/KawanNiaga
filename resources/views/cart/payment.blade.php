<x-storefront-layout>
<main class="flex-grow w-full max-w-[800px] mx-auto px-6 md:px-12 pt-[140px] md:pt-[160px] pb-12" x-data="countdownTimer(15)">
    <div class="outer-shell">
        <div class="inner-core bg-white p-8 md:p-12 relative overflow-hidden text-center flex flex-col items-center">
            <!-- Background Decorative Element -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-[#121212]/5 rounded-full blur-3xl pointer-events-none transform translate-x-1/2 -translate-y-1/2"></div>
            
            <div class="relative z-10 w-full flex flex-col items-center">
                <div class="w-24 h-24 bg-[#121212] rounded-full flex items-center justify-center mb-6 shadow-sm">
                    <i class="ph text-white text-4xl {{ session('pending_payment.method') == 'ewallet' ? 'ph-qr-code' : (session('pending_payment.method') == 'cc' ? 'ph-credit-card' : 'ph-bank') }}"></i>
                </div>
                
                <h1 class="text-3xl md:text-4xl font-display font-semibold text-[#121212] tracking-tight-display mb-3">Selesaikan Pembayaran</h1>
                <p class="font-jakarta text-[#121212]/60 mb-8 max-w-sm">Segera selesaikan pembayaran agar pesanan Anda bisa langsung kami proses.</p>
                
                <!-- Timer -->
                <div class="bg-red-50 border border-red-100 text-red-600 rounded-full px-6 py-2 flex items-center gap-2 mb-8 font-jakarta font-semibold text-lg">
                    <i class="ph ph-timer animate-pulse text-xl"></i>
                    <span x-text="timeDisplay">15:00</span>
                </div>
                
                <div class="w-full max-w-sm bg-[#fcfcfc] border border-[#121212]/10 p-6 rounded-2xl mb-8 font-jakarta">
                    <p class="text-sm font-semibold text-[#121212]/60 uppercase tracking-widest mb-2">Total Tagihan</p>
                    <p class="text-4xl font-display font-semibold text-[#121212] tracking-tight-display mb-6">Rp {{ number_format(session('pending_payment.total', 0), 0, ',', '.') }}</p>
                    
                    @if(session('pending_payment.method') == 'ewallet')
                        <p class="font-semibold text-[#121212] mb-4">Scan QRIS (OVO/GoPay/Dana)</p>
                        <!-- QR Code Area -->
                        <div class="bg-white p-4 inline-block shadow-sm border border-[#121212]/10 rounded-2xl">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=KAWANNIAGA-PAY-{{ time() }}&bgcolor=ffffff&color=121212&margin=0" alt="QRIS Code" class="w-56 h-56 rounded-xl">
                        </div>
                    @elseif(session('pending_payment.method') == 'cc')
                        <p class="font-semibold text-[#121212] mb-4">Detail Kartu Kredit / Debit</p>
                        <div class="flex flex-col gap-3 text-left">
                            <div>
                                <label class="text-xs text-[#121212]/60 font-semibold mb-1 block uppercase tracking-widest">Nomor Kartu</label>
                                <div class="flex items-center bg-white rounded-xl border border-[#121212]/10 px-3 py-2 focus-within:border-[#121212] transition-colors">
                                    <i class="ph ph-credit-card text-[#121212]/40 text-xl mr-2"></i>
                                    <input type="text" placeholder="0000 0000 0000 0000" class="flex-grow bg-transparent border-none focus:ring-0 text-[#121212] placeholder:text-[#121212]/30 p-0 tracking-widest text-sm font-medium" maxlength="19">
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="flex-1">
                                    <label class="text-xs text-[#121212]/60 font-semibold mb-1 block uppercase tracking-widest">Valid Thru</label>
                                    <input type="text" placeholder="MM/YY" class="w-full bg-white rounded-xl border border-[#121212]/10 px-3 py-2 text-sm focus:border-[#121212] focus:ring-0 text-[#121212] placeholder:text-[#121212]/30 transition-colors font-medium text-center" maxlength="5">
                                </div>
                                <div class="w-24">
                                    <label class="text-xs text-[#121212]/60 font-semibold mb-1 block uppercase tracking-widest">CVV</label>
                                    <input type="password" placeholder="123" class="w-full bg-white rounded-xl border border-[#121212]/10 px-3 py-2 text-sm focus:border-[#121212] focus:ring-0 text-[#121212] placeholder:text-[#121212]/30 transition-colors font-medium text-center" maxlength="3">
                                </div>
                            </div>
                            <div>
                                <label class="text-xs text-[#121212]/60 font-semibold mb-1 block uppercase tracking-widest">Nama di Kartu</label>
                                <input type="text" placeholder="BUDI SANTOSO" class="w-full bg-white rounded-xl border border-[#121212]/10 px-3 py-2 text-sm focus:border-[#121212] focus:ring-0 text-[#121212] placeholder:text-[#121212]/30 transition-colors uppercase font-medium">
                            </div>
                        </div>
                    @else
                        <p class="font-semibold text-[#121212] mb-1">Transfer ke Virtual Account</p>
                        <p class="text-sm text-[#121212]/60 mb-4">Bank BCA / Mandiri / BNI / BRI</p>
                        
                        <div class="flex items-center gap-2 bg-white rounded-xl border border-[#121212]/10 p-2 relative">
                            <input type="text" readonly value="{{ session('pending_payment.va_number', '8077 0000 0000 00') }}" class="flex-grow bg-transparent border-none focus:ring-0 text-center font-display font-semibold text-xl tracking-widest text-[#121212]" id="va-number">
                            <button onclick="copyVA()" class="text-[#121212]/60 hover:text-[#121212] p-2 rounded-lg hover:bg-[#121212]/5 transition-colors" title="Salin Nomor">
                                <i class="ph ph-copy text-xl"></i>
                            </button>
                        </div>
                        <p id="copy-msg" class="text-xs font-semibold text-green-600 mt-2 opacity-0 transition-opacity">Nomor berhasil disalin!</p>
                    @endif
                </div>

                <!-- Form Konfirmasi -->
                <form action="{{ route('payment.confirm') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full md:w-auto px-12 py-4 bg-[#121212] hover:bg-black text-white font-jakarta font-semibold rounded-full shadow-sm transition-colors active:scale-95 flex items-center justify-center gap-2 mx-auto text-lg">
                        <i class="ph ph-check-circle text-2xl"></i>
                        Saya Sudah Bayar
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('countdownTimer', (minutes) => ({
            timeLeft: minutes * 60,
            timeDisplay: '15:00',
            init() {
                let timerInterval = setInterval(() => {
                    this.timeLeft--;
                    let m = Math.floor(this.timeLeft / 60);
                    let s = this.timeLeft % 60;
                    this.timeDisplay = `${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
                    
                    if (this.timeLeft <= 0) {
                        clearInterval(timerInterval);
                        window.location.href = "{{ route('cart.index') }}"; // Redirect ke keranjang jika waktu habis
                    }
                }, 1000);
            }
        }));
    });

    function copyVA() {
        var copyText = document.getElementById("va-number");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        
        let msg = document.getElementById("copy-msg");
        msg.style.opacity = 1;
        setTimeout(() => {
            msg.style.opacity = 0;
        }, 2000);
    }
</script>
</x-storefront-layout>
