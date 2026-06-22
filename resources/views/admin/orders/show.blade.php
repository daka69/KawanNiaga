<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.orders.index') }}" class="text-[#121212]/60 hover:text-[#121212] transition-colors bg-white hover:bg-[#121212]/5 w-10 h-10 flex items-center justify-center rounded-full border border-[#121212]/10 shadow-sm">
                    <i class="ph ph-arrow-left text-xl"></i>
                </a>
                <h2 class="font-semibold text-3xl text-[#121212] font-display tracking-tight-display">
                    Pesanan <span class="text-[#121212]/50">#{{ $order->order_number }}</span>
                </h2>
            </div>
            
            @php
                $statusStyles = [
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'paid' => 'bg-blue-100 text-blue-800',
                    'processing' => 'bg-indigo-100 text-indigo-800',
                    'shipped' => 'bg-purple-100 text-purple-800',
                    'completed' => 'bg-green-100 text-green-800',
                    'cancelled' => 'bg-red-100 text-red-800',
                ];
                $statusLabels = [
                    'pending' => 'Pending', 'paid' => 'Lunas',
                    'processing' => 'Diproses', 'shipped' => 'Dikirim',
                    'completed' => 'Selesai', 'cancelled' => 'Batal',
                ];
                $style = $statusStyles[$order->status] ?? 'bg-gray-100 text-gray-800';
                $label = $statusLabels[$order->status] ?? $order->status;
            @endphp
            <div class="px-4 py-2 rounded-full {{ $style }} font-bold text-xs uppercase tracking-wider font-jakarta flex items-center gap-2 w-fit">
                <i class="ph ph-info"></i> {{ $label }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="outer-shell mb-8 motion-fluid">
                    <div class="inner-core bg-[#121212] text-white p-4 flex items-center gap-3">
                        <i class="ph ph-check-circle text-xl text-green-400"></i>
                        <span class="font-jakarta font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Kolom Kiri: Detail Order & Items -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Update Status Card -->
                    <div class="outer-shell shadow-sm">
                        <div class="inner-core bg-white flex flex-col">
                            <div class="p-6 border-b border-[#121212]/5 bg-[#fcfcfc]">
                                <h3 class="text-lg font-semibold text-[#121212] font-display tracking-tight-display flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-[#121212]/5 flex items-center justify-center text-[#121212]"><i class="ph ph-arrows-clockwise text-lg"></i></div>
                                    Update Status Pesanan
                                </h3>
                            </div>
                            <div class="p-6 bg-white">
                                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="flex flex-col sm:flex-row gap-4 items-end">
                                    @csrf
                                    @method('PATCH')
                                    <div class="w-full sm:w-2/3">
                                        <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Ubah Status Menjadi:</label>
                                        <div class="relative">
                                            <select name="status" id="status-select" class="appearance-none w-full bg-[#fcfcfc] border border-[#121212]/10 text-[#121212] rounded-xl focus:border-[#121212] focus:ring-0 outline-none font-jakarta px-4 py-3 pr-10 cursor-pointer">
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Lunas</option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Batal</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-[#121212]/50">
                                                <i class="ph ph-caret-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" id="submit-status" class="w-full sm:w-1/3 bg-[#121212] text-white hover:bg-black px-6 py-3 rounded-xl font-semibold font-jakarta transition-colors shadow-sm flex items-center justify-center gap-2">
                                        <i class="ph ph-check"></i> Simpan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Items List -->
                    <div class="outer-shell shadow-sm">
                        <div class="inner-core bg-white flex flex-col">
                            <div class="p-6 border-b border-[#121212]/5 bg-[#fcfcfc]">
                                <h3 class="text-lg font-semibold text-[#121212] font-display tracking-tight-display flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-[#121212]/5 flex items-center justify-center text-[#121212]"><i class="ph ph-package text-lg"></i></div>
                                    Produk yang Dipesan
                                </h3>
                            </div>
                            <div class="divide-y divide-[#121212]/5">
                                @foreach($order->items as $item)
                                <div class="p-6 flex flex-col sm:flex-row gap-4 items-start sm:items-center bg-white hover:bg-[#121212]/[0.02] transition-colors">
                                    <div class="w-16 h-16 bg-[#121212]/5 rounded-xl border border-[#121212]/10 flex items-center justify-center overflow-hidden flex-shrink-0">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/64/Foods_%28cropped%29.jpg" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="text-[#121212] font-semibold font-jakarta">{{ $item->product_name }}</h4>
                                        <p class="text-[#121212]/60 text-sm mt-1 font-jakarta">Rp {{ number_format($item->price, 0, ',', '.') }} × {{ $item->quantity }}</p>
                                    </div>
                                    <div class="text-right mt-2 sm:mt-0">
                                        <p class="text-xs font-semibold text-[#121212]/50 uppercase tracking-widest mb-1 font-jakarta">Subtotal</p>
                                        <p class="text-[#121212] font-bold font-jakarta text-lg">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="p-6 bg-[#fcfcfc] border-t border-[#121212]/5 flex flex-col gap-3 font-jakarta">
                                <div class="flex justify-between text-sm text-[#121212]/70 font-semibold">
                                    <span>Total Harga Barang:</span>
                                    <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-sm text-[#121212]/70 font-semibold">
                                    <span>Ongkos Kirim:</span>
                                    <span>Rp {{ number_format($order->delivery_fee, 0, ',', '.') }}</span>
                                </div>
                                @if($order->discount > 0)
                                <div class="flex justify-between text-sm text-green-600 font-bold">
                                    <span>Diskon Promo:</span>
                                    <span>-Rp {{ number_format($order->discount, 0, ',', '.') }}</span>
                                </div>
                                @endif
                                <div class="flex justify-between items-center mt-4 pt-4 border-t border-[#121212]/5">
                                    <span class="text-[#121212] font-semibold font-display tracking-tight-display text-xl">Total Pembayaran:</span>
                                    <span class="text-3xl text-[#121212] font-bold font-display tracking-tight-display">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Info Pelanggan & Pengiriman -->
                <div class="space-y-6">
                    <div class="outer-shell shadow-sm">
                        <div class="inner-core bg-white flex flex-col">
                            <div class="p-6 border-b border-[#121212]/5 bg-[#fcfcfc]">
                                <h3 class="text-lg font-semibold text-[#121212] font-display tracking-tight-display flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-[#121212]/5 flex items-center justify-center text-[#121212]"><i class="ph ph-user text-lg"></i></div>
                                    Informasi Pembeli
                                </h3>
                            </div>
                            <div class="p-6 space-y-5 bg-white font-jakarta">
                                <div>
                                    <p class="text-xs font-semibold text-[#121212]/50 uppercase tracking-widest mb-1">Nama Lengkap</p>
                                    <p class="text-[#121212] font-semibold">{{ $order->user->name ?? 'User Terhapus' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-[#121212]/50 uppercase tracking-widest mb-1">Email</p>
                                    <p class="text-[#121212] font-medium">{{ $order->user->email ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-[#121212]/50 uppercase tracking-widest mb-1">No. Telepon</p>
                                    <p class="text-[#121212] font-medium">{{ $order->user->phone ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="outer-shell shadow-sm">
                        <div class="inner-core bg-white flex flex-col">
                            <div class="p-6 border-b border-[#121212]/5 bg-[#fcfcfc]">
                                <h3 class="text-lg font-semibold text-[#121212] font-display tracking-tight-display flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-[#121212]/5 flex items-center justify-center text-[#121212]"><i class="ph ph-map-pin text-lg"></i></div>
                                    Alamat Pengiriman
                                </h3>
                            </div>
                            <div class="p-6 bg-white">
                                <p class="text-[#121212]/80 leading-relaxed text-sm font-jakarta font-medium">
                                    {{ $order->shipping_address }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="outer-shell shadow-sm">
                        <div class="inner-core bg-white flex flex-col">
                            <div class="p-6 border-b border-[#121212]/5 bg-[#fcfcfc]">
                                <h3 class="text-lg font-semibold text-[#121212] font-display tracking-tight-display flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-[#121212]/5 flex items-center justify-center text-[#121212]"><i class="ph ph-credit-card text-lg"></i></div>
                                    Metode Pembayaran
                                </h3>
                            </div>
                            <div class="p-6 bg-white">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-[#121212]/5 flex items-center justify-center border border-[#121212]/10">
                                        @if($order->payment_method == 'va')
                                            <i class="ph ph-bank text-2xl text-[#121212]"></i>
                                        @elseif($order->payment_method == 'ewallet')
                                            <i class="ph ph-qr-code text-2xl text-[#121212]"></i>
                                        @else
                                            <i class="ph ph-credit-card text-2xl text-[#121212]"></i>
                                        @endif
                                    </div>
                                    <div class="font-jakarta">
                                        <p class="text-[#121212] font-bold text-sm">
                                            {{ $order->payment_method == 'va' ? 'Virtual Account' : ($order->payment_method == 'ewallet' ? 'E-Wallet / QRIS' : 'Kartu Kredit') }}
                                        </p>
                                        <p class="text-[#121212]/50 text-xs font-semibold uppercase tracking-wider mt-0.5"><i class="ph ph-check-circle text-green-500 mr-1"></i>Otomatis</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
