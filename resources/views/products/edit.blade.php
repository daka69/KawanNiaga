<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('products.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-[#121212]/5 hover:bg-[#121212]/10 text-[#121212] transition-colors">
                <i class="ph ph-arrow-left text-xl"></i>
            </a>
            <h2 class="font-semibold text-3xl text-[#121212] font-display tracking-tight-display">
                {{ __('Edit SKU') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="outer-shell shadow-ambient">
                <div class="inner-core bg-white p-8 sm:p-10">
                    @if($errors->any())
                        <div class="mb-8 bg-red-50 border border-red-100 text-red-700 p-4 rounded-xl flex flex-col gap-2">
                            <div class="flex items-center gap-3">
                                <i class="ph ph-warning-circle text-xl"></i>
                                <span class="font-jakarta font-semibold">Gagal menyimpan data:</span>
                            </div>
                            <ul class="list-disc pl-10 font-jakarta text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Nama Produk</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full rounded-xl bg-[#fcfcfc] border-[#121212]/10 text-[#121212] focus:border-[#121212] focus:ring focus:ring-[#121212]/10 font-jakarta px-4 py-3" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Kategori</label>
                            <input type="text" name="category" value="{{ old('category', $product->category) }}" class="w-full rounded-xl bg-[#fcfcfc] border-[#121212]/10 text-[#121212] focus:border-[#121212] focus:ring focus:ring-[#121212]/10 font-jakarta px-4 py-3" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Deskripsi Produk</label>
                            <textarea name="description" rows="4" class="w-full rounded-xl bg-[#fcfcfc] border-[#121212]/10 text-[#121212] focus:border-[#121212] focus:ring focus:ring-[#121212]/10 font-jakarta px-4 py-3">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Gambar Produk</label>
                            @if($product->image)
                                <div class="mb-4 outer-shell inline-block">
                                    <div class="inner-core bg-[#fcfcfc] p-2">
                                        <img src="{{ $product->image }}" alt="Current Image" class="h-32 w-32 object-cover rounded-[1rem] border border-[#121212]/5">
                                    </div>
                                </div>
                            @endif
                            <input type="file" name="image" accept="image/*" class="w-full text-[#121212]/70 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#121212]/5 file:text-[#121212] hover:file:bg-[#121212] hover:file:text-white font-jakarta cursor-pointer">
                            <p class="text-xs text-[#121212]/40 mt-2 font-jakarta">Kosongkan jika tidak ingin mengubah gambar saat ini.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Stok Tersedia (SOH)</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full rounded-xl bg-[#fcfcfc] border-[#121212]/10 text-[#121212] focus:border-[#121212] focus:ring focus:ring-[#121212]/10 font-jakarta px-4 py-3" required>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Harga Modal</label>
                                <input type="number" name="capital_price" value="{{ old('capital_price', $product->capital_price) }}" class="w-full rounded-xl bg-[#fcfcfc] border-[#121212]/10 text-[#121212] focus:border-[#121212] focus:ring focus:ring-[#121212]/10 font-jakarta px-4 py-3" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-[#121212]/70 mb-2 font-jakarta">Harga Jual</label>
                                <input type="number" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" class="w-full rounded-xl bg-[#fcfcfc] border-[#121212]/10 text-[#121212] focus:border-[#121212] focus:ring focus:ring-[#121212]/10 font-jakarta px-4 py-3" required>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-6 border-t border-[#121212]/5">
                            <a href="{{ route('products.index') }}" class="px-6 py-2.5 rounded-full bg-[#121212]/5 border border-[#121212]/10 text-[#121212] hover:bg-[#121212]/10 font-semibold font-jakarta transition-colors w-full sm:w-auto text-center">Batal</a>
                            <button type="submit" class="bg-[#121212] hover:bg-black text-white px-8 py-2.5 rounded-full font-semibold font-jakarta transition-colors shadow-sm w-full sm:w-auto text-center">Perbarui SKU</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
