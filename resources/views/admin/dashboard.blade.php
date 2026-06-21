<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-[#121212] font-display tracking-tight-display">
            {{ __('Dashboard Operasional') }}
        </h2>
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

            <!-- Analytics Cards (Asymmetrical Bento) -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                
                <!-- Main Profit Card (Span 8) -->
                <div class="outer-shell md:col-span-8 shadow-sm hover:shadow-ambient motion-fluid group">
                    <div class="inner-core p-8 h-full flex flex-col justify-between relative overflow-hidden bg-white">
                        <div class="absolute -right-8 -top-8 w-48 h-48 bg-[#121212]/5 rounded-full blur-3xl group-hover:bg-[#121212]/10 transition-colors"></div>
                        <div class="relative z-10 flex items-center justify-between mb-8">
                            <h3 class="text-sm font-semibold text-[#121212]/50 font-jakarta uppercase tracking-widest flex items-center gap-2">
                                <i class="ph ph-trend-up text-lg"></i> Total Profit Hari Ini
                            </h3>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-[10px] font-bold rounded-full uppercase tracking-wider">+12%</span>
                        </div>
                        <p class="text-5xl lg:text-6xl text-[#121212] font-semibold font-display tracking-tight-display relative z-10">
                            Rp {{ number_format($totalProfitToday, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <!-- Secondary Cards (Span 4) -->
                <div class="md:col-span-4 flex flex-col gap-6">
                    <div class="outer-shell shadow-sm hover:-translate-y-1 motion-fluid flex-1">
                        <div class="inner-core p-6 h-full bg-[#fdfdfd]">
                            <h3 class="text-xs font-semibold text-[#121212]/50 font-jakarta uppercase tracking-widest mb-2 flex items-center gap-2">
                                <i class="ph ph-wallet text-lg"></i> Omzet
                            </h3>
                            <p class="text-3xl text-[#121212] font-semibold font-display tracking-tight-display">
                                Rp {{ number_format($totalSalesToday, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <div class="outer-shell shadow-sm hover:-translate-y-1 motion-fluid flex-1">
                        <div class="inner-core p-6 h-full bg-[#fdfdfd]">
                            <h3 class="text-xs font-semibold text-[#121212]/50 font-jakarta uppercase tracking-widest mb-2 flex items-center gap-2">
                                <i class="ph ph-package text-lg"></i> Item Aktif
                            </h3>
                            <p class="text-3xl text-[#121212] font-semibold font-display tracking-tight-display">
                                {{ $productsCount }} SKU
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Low Stock Alerts -->
            @if($lowStockProducts->count() > 0)
            <div class="outer-shell mt-10 shadow-[0_10px_40px_rgba(239,68,68,0.1)]">
                <div class="inner-core p-6 bg-red-50/50 border border-red-100">
                    <h3 class="text-red-700 font-semibold text-lg font-jakarta mb-4 flex items-center gap-2">
                        <i class="ph ph-warning-circle text-xl animate-pulse"></i>
                        Peringatan Stok Menipis
                    </h3>
                    <ul class="list-disc list-inside text-red-600 font-jakarta text-sm space-y-1">
                        @foreach($lowStockProducts as $p)
                            <li><span class="font-medium">{{ $p->name }}</span> (Sisa: {{ $p->stock }})</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <!-- Recent Orders & Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-10">
                
                <!-- Recent Orders Table (Span 8) -->
                <div class="outer-shell lg:col-span-8 shadow-sm">
                    <div class="inner-core bg-white overflow-hidden flex flex-col h-full">
                        <div class="p-6 border-b border-[#121212]/5 flex justify-between items-center">
                            <h3 class="text-xl font-semibold text-[#121212] font-display tracking-tight-display">Pesanan Terbaru</h3>
                            <a href="{{ route('admin.orders.index') }}" class="text-[#121212]/60 hover:text-[#121212] text-sm font-jakarta font-medium flex items-center gap-1 transition-colors">Semua <i class="ph ph-arrow-right"></i></a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-[#121212]/5">
                                <thead class="bg-[#fcfcfc]">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#121212]/50 uppercase tracking-widest font-jakarta">ID</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#121212]/50 uppercase tracking-widest font-jakarta">Pembeli</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#121212]/50 uppercase tracking-widest font-jakarta">Total</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-[#121212]/50 uppercase tracking-widest font-jakarta">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#121212]/5 bg-white">
                                    @forelse($recentOrders ?? [] as $order)
                                    <tr class="hover:bg-[#121212]/[0.02] transition-colors">
                                        <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-[#121212] font-jakarta">
                                            #{{ $order->order_number }}
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-sm text-[#121212]/70 font-jakarta">
                                            {{ $order->user->name ?? 'Unknown' }}
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-sm text-[#121212] font-semibold font-jakarta">
                                            Rp {{ number_format($order->total, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            @if($order->status === 'pending')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                            @else
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800">Lunas</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 whitespace-nowrap text-sm text-[#121212]/50 text-center font-jakarta">
                                            <i class="ph ph-receipt text-3xl mb-2 block"></i>
                                            Belum ada pesanan masuk.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions (Span 4) -->
                <div class="outer-shell lg:col-span-4 shadow-sm group">
                    <div class="inner-core p-8 bg-[#121212] text-white flex flex-col h-full justify-between relative overflow-hidden">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-white/5 rounded-bl-[100px]"></div>
                        <div>
                            <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center mb-6">
                                <i class="ph ph-cube text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-semibold mb-3 font-display tracking-tight-display">Katalog Produk</h3>
                            <p class="text-white/60 font-jakarta text-sm leading-relaxed mb-8">Pusat kendali inventori. Tambahkan SKU baru, perbarui harga, dan pastikan ketersediaan stok.</p>
                        </div>
                        <a href="{{ route('products.index') }}" class="group/btn inline-flex items-center justify-between bg-white text-[#121212] font-semibold font-jakarta py-3 px-6 rounded-full hover:bg-gray-100 transition-colors shadow-[0_0_20px_rgba(255,255,255,0.2)]">
                            Kelola Produk
                            <i class="ph ph-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
