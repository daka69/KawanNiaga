<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-[#121212] font-display tracking-tight-display">
            {{ __('Manajemen Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="outer-shell mb-8 motion-fluid">
                    <div class="inner-core bg-[#121212] text-white p-4 flex items-center gap-3">
                        <i class="ph ph-check-circle text-xl text-green-400"></i>
                        <span class="font-jakarta font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="outer-shell shadow-sm overflow-hidden">
                <div class="inner-core bg-white flex flex-col">
                    <div class="p-6 border-b border-[#121212]/5 flex flex-col md:flex-row justify-between md:items-center gap-4 bg-[#fcfcfc]">
                        <h3 class="text-xl font-semibold text-[#121212] font-display tracking-tight-display">Daftar Pesanan Masuk</h3>
                        
                        <!-- Filter Status -->
                        <form action="{{ route('admin.orders.index') }}" method="GET" class="flex items-center gap-2">
                            <div class="relative">
                                <select name="status" class="appearance-none bg-white border border-[#121212]/10 text-[#121212] rounded-full font-jakarta text-sm px-6 py-2.5 pr-10 focus:border-[#121212] focus:ring-0 outline-none transition-colors shadow-sm cursor-pointer">
                                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Sudah Dibayar</option>
                                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Diproses</option>
                                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-[#121212]/50">
                                    <i class="ph ph-caret-down"></i>
                                </div>
                            </div>
                            <button type="submit" class="bg-[#121212] hover:bg-black text-white px-6 py-2.5 rounded-full font-jakarta text-sm font-semibold transition-colors shadow-sm flex items-center gap-2">
                                <i class="ph ph-funnel"></i> Filter
                            </button>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-[#121212]/5">
                            <thead class="bg-white">
                                <tr>
                                    <th scope="col" class="px-6 py-5 text-left text-xs font-semibold text-[#121212]/50 uppercase tracking-widest font-jakarta">No. Pesanan</th>
                                    <th scope="col" class="px-6 py-5 text-left text-xs font-semibold text-[#121212]/50 uppercase tracking-widest font-jakarta">Tanggal</th>
                                    <th scope="col" class="px-6 py-5 text-left text-xs font-semibold text-[#121212]/50 uppercase tracking-widest font-jakarta">Pembeli</th>
                                    <th scope="col" class="px-6 py-5 text-left text-xs font-semibold text-[#121212]/50 uppercase tracking-widest font-jakarta">Total</th>
                                    <th scope="col" class="px-6 py-5 text-left text-xs font-semibold text-[#121212]/50 uppercase tracking-widest font-jakarta">Status</th>
                                    <th scope="col" class="px-6 py-5 text-left text-xs font-semibold text-[#121212]/50 uppercase tracking-widest font-jakarta">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#121212]/5 bg-white">
                                @forelse($orders as $order)
                                <tr class="hover:bg-[#121212]/[0.02] transition-colors">
                                    <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-[#121212] font-jakarta">
                                        #{{ $order->order_number }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-[#121212]/60 font-jakarta">
                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-[#121212]/80 font-jakarta">
                                        {{ $order->user->name ?? 'Unknown' }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-[#121212] font-jakarta font-bold">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
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
                                                'pending' => 'Pending',
                                                'paid' => 'Lunas',
                                                'processing' => 'Diproses',
                                                'shipped' => 'Dikirim',
                                                'completed' => 'Selesai',
                                                'cancelled' => 'Batal',
                                            ];
                                            
                                            $style = $statusStyles[$order->status] ?? 'bg-gray-100 text-gray-800';
                                            $label = $statusLabels[$order->status] ?? $order->status;
                                        @endphp
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full uppercase tracking-wider {{ $style }}">
                                            {{ $label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-[#121212] bg-[#121212]/5 hover:bg-[#121212]/10 font-jakarta px-4 py-2 rounded-full transition-colors flex items-center justify-center gap-1 w-fit font-semibold">
                                            Kelola <i class="ph ph-arrow-right"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 whitespace-nowrap text-sm text-[#121212]/50 text-center font-jakarta">
                                        <div class="flex flex-col items-center justify-center gap-3">
                                            <i class="ph ph-receipt text-4xl"></i>
                                            <p class="text-base">Belum ada data pesanan.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($orders->hasPages())
                    <div class="p-6 border-t border-[#121212]/5 bg-white">
                        {{ $orders->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
