<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-[#121212] font-display tracking-tight-display">
            {{ __('Katalog Internal') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ isModalOpen: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="outer-shell mb-8 motion-fluid">
                    <div class="inner-core bg-[#121212] text-white p-4 flex items-center gap-3">
                        <i class="ph ph-check-circle text-xl text-green-400"></i>
                        <span class="font-jakarta font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Excel Import/Export Panel -->
            <div class="outer-shell mb-6 shadow-sm">
                <div class="inner-core bg-white p-6 flex flex-col md:flex-row justify-between items-center gap-4">
                    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-4 w-full md:w-auto">
                        @csrf
                        <div class="relative flex-grow md:flex-grow-0">
                            <input type="file" name="file" class="block w-full text-sm text-[#121212]/60 font-jakarta file:mr-4 file:py-2.5 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#121212]/5 file:text-[#121212] hover:file:bg-[#121212] hover:file:text-white transition-colors cursor-pointer" required>
                        </div>
                        <button type="submit" class="bg-[#121212] hover:bg-black text-white font-semibold font-jakarta py-2.5 px-6 rounded-full transition-colors shadow-sm whitespace-nowrap flex items-center gap-2">
                            <i class="ph ph-upload-simple text-lg"></i> Import
                        </button>
                    </form>
                    
                    <a href="{{ route('products.export') }}" class="border border-[#121212]/10 text-[#121212] hover:bg-[#121212]/5 font-semibold font-jakarta py-2.5 px-6 rounded-full transition-colors flex items-center gap-2">
                        <i class="ph ph-download-simple text-lg"></i> Export
                    </a>
                </div>
            </div>

            <!-- Product Table -->
            <div class="outer-shell shadow-sm">
                <div class="inner-core bg-white overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-[#121212]/5 bg-[#fcfcfc] flex justify-between items-center">
                        <h3 class="text-xl font-semibold text-[#121212] font-display tracking-tight-display">Daftar SKU Aktif</h3>
                        <button @click="isModalOpen = true" class="bg-[#121212] hover:bg-black text-white shadow-sm font-semibold font-jakarta py-2.5 px-6 rounded-full transition-colors flex items-center gap-2">
                            <i class="ph ph-plus text-lg"></i> Tambah Baru
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-white text-[#121212]/50 font-jakarta text-xs uppercase tracking-widest border-b border-[#121212]/5">
                                    <th class="p-6 font-semibold">Produk</th>
                                    <th class="p-6 font-semibold">Kategori</th>
                                    <th class="p-6 font-semibold">SOH</th>
                                    <th class="p-6 font-semibold text-right">Modal</th>
                                    <th class="p-6 font-semibold text-right">Jual</th>
                                    <th class="p-6 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#121212]/5 text-[#121212] font-jakarta">
                                @foreach($products as $p)
                                <tr class="bg-white hover:bg-[#121212]/[0.02] transition-colors">
                                    <td class="p-6 font-medium">{{ $p->name }}</td>
                                    <td class="p-6 text-[#121212]/60 text-sm">{{ $p->category }}</td>
                                    <td class="p-6 font-jakarta">
                                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $p->stock < 10 ? 'bg-red-100 text-red-800' : 'bg-[#121212]/5 text-[#121212]' }}">
                                            {{ $p->stock }}
                                        </span>
                                    </td>
                                    <td class="p-6 text-right font-semibold text-sm text-[#121212]/60">{{ number_format($p->capital_price, 0, ',', '.') }}</td>
                                    <td class="p-6 text-right font-bold text-[#121212]">{{ number_format($p->selling_price, 0, ',', '.') }}</td>
                                    <td class="p-6 flex justify-center gap-2">
                                        <a href="{{ route('products.edit', $p->id) }}" class="text-[#121212]/60 hover:text-[#121212] bg-[#121212]/5 hover:bg-[#121212]/10 rounded-full w-8 h-8 flex items-center justify-center transition-colors"><i class="ph ph-pencil-simple text-lg"></i></a>
                                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus SKU ini secara permanen?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 rounded-full w-8 h-8 flex items-center justify-center transition-colors"><i class="ph ph-trash text-lg"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create -->
        <div x-show="isModalOpen" style="display: none;" class="fixed inset-0 bg-[#121212]/40 flex items-center justify-center z-50 backdrop-blur-md" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div @click.away="isModalOpen = false" class="outer-shell w-full max-w-lg shadow-ambient" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-8 scale-95">
                <div class="inner-core bg-white p-8 h-full flex flex-col relative">
                    <button @click="isModalOpen = false" class="absolute top-6 right-6 w-8 h-8 flex items-center justify-center rounded-full bg-[#121212]/5 hover:bg-[#121212]/10 text-[#121212] transition-colors"><i class="ph ph-x"></i></button>
                    
                    <h2 class="text-2xl font-semibold text-[#121212] mb-6 border-b border-[#121212]/5 pb-4 font-display tracking-tight-display">Registrasi SKU Baru</h2>
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Nama Produk</label>
                            <input type="text" name="name" class="w-full rounded-xl bg-[#fcfcfc] border-[#121212]/10 text-[#121212] focus:border-[#121212] focus:ring focus:ring-[#121212]/10 font-jakarta px-4 py-3" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Kategori</label>
                            <input type="text" name="category" class="w-full rounded-xl bg-[#fcfcfc] border-[#121212]/10 text-[#121212] focus:border-[#121212] focus:ring focus:ring-[#121212]/10 font-jakarta px-4 py-3">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Deskripsi Produk</label>
                            <textarea name="description" rows="3" class="w-full rounded-xl bg-[#fcfcfc] border-[#121212]/10 text-[#121212] focus:border-[#121212] focus:ring focus:ring-[#121212]/10 font-jakarta px-4 py-3"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Gambar Produk (Opsional)</label>
                            <input type="file" name="image" accept="image/*" class="w-full text-[#121212]/70 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#121212]/5 file:text-[#121212] hover:file:bg-[#121212] hover:file:text-white font-jakarta cursor-pointer">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Stok Awal (SOH)</label>
                            <input type="number" name="stock" class="w-full rounded-xl bg-[#fcfcfc] border-[#121212]/10 text-[#121212] focus:border-[#121212] focus:ring focus:ring-[#121212]/10 font-jakarta px-4 py-3" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Harga Modal</label>
                                <input type="number" name="capital_price" class="w-full rounded-xl bg-[#fcfcfc] border-[#121212]/10 text-[#121212] focus:border-[#121212] focus:ring focus:ring-[#121212]/10 font-jakarta px-4 py-3" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Harga Jual</label>
                                <input type="number" name="selling_price" class="w-full rounded-xl bg-[#fcfcfc] border-[#121212]/10 text-[#121212] focus:border-[#121212] focus:ring focus:ring-[#121212]/10 font-jakarta px-4 py-3" required>
                            </div>
                        </div>
                        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-[#121212]/5">
                            <button type="button" @click="isModalOpen = false" class="px-6 py-2.5 rounded-full text-[#121212]/60 hover:bg-[#121212]/5 hover:text-[#121212] font-semibold font-jakarta transition-colors">Batal</button>
                            <button type="submit" class="bg-[#121212] hover:bg-black text-white px-8 py-2.5 rounded-full font-semibold font-jakarta transition-colors shadow-sm">Simpan SKU</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
