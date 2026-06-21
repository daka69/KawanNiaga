<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('products.index') }}" class="text-on-surface-variant hover:text-light-on-surface transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-2xl text-light-on-surface font-manrope">
                {{ __('Edit SKU') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-surface-container-lowest p-8 rounded-card shadow-sm border border-outline-variant/30">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-semibold text-on-surface-variant mb-2 font-inter">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full rounded-soft bg-white border-outline-variant/30 text-light-on-surface focus:border-light-primary focus:ring focus:ring-light-primary focus:ring-opacity-50 font-inter" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-on-surface-variant mb-2 font-inter">Kategori</label>
                        <input type="text" name="category" value="{{ old('category', $product->category) }}" class="w-full rounded-soft bg-white border-outline-variant/30 text-light-on-surface focus:border-light-primary focus:ring focus:ring-light-primary focus:ring-opacity-50 font-inter">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-on-surface-variant mb-2 font-inter">Deskripsi Produk</label>
                        <textarea name="description" rows="4" class="w-full rounded-soft bg-white border-outline-variant/30 text-light-on-surface focus:border-light-primary focus:ring focus:ring-light-primary focus:ring-opacity-50 font-inter">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-on-surface-variant mb-2 font-inter">Gambar Produk</label>
                        @if($product->image)
                            <div class="mb-3">
                                <img src="{{ $product->image }}" alt="Current Image" class="h-32 w-32 object-cover rounded-md border border-outline-variant/30">
                            </div>
                        @endif
                        <input type="file" name="image" accept="image/*" class="w-full text-light-on-surface text-sm file:mr-4 file:py-2 file:px-4 file:rounded-soft file:border-0 file:text-sm file:font-semibold file:bg-light-primary-fixed file:text-light-on-surface hover:file:bg-light-primary hover:file:text-white font-inter">
                        <p class="text-xs text-on-surface-variant mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-on-surface-variant mb-2 font-inter">Stok Tersedia (SOH)</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full rounded-soft bg-white border-outline-variant/30 text-light-on-surface focus:border-light-primary focus:ring focus:ring-light-primary focus:ring-opacity-50 font-jetbrains" required>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-on-surface-variant mb-2 font-inter">Harga Modal</label>
                            <input type="number" name="capital_price" value="{{ old('capital_price', $product->capital_price) }}" class="w-full rounded-soft bg-white border-outline-variant/30 text-light-on-surface focus:border-light-primary focus:ring focus:ring-light-primary focus:ring-opacity-50 font-jetbrains" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-on-surface-variant mb-2 font-inter">Harga Jual</label>
                            <input type="number" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" class="w-full rounded-soft bg-white border-outline-variant/30 text-light-on-surface focus:border-light-primary focus:ring focus:ring-light-primary focus:ring-opacity-50 font-jetbrains" required>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-outline-variant/30">
                        <a href="{{ route('products.index') }}" class="px-6 py-2.5 rounded-soft text-on-surface-variant hover:text-light-on-surface font-semibold font-inter transition-colors">Batal</a>
                        <button type="submit" class="bg-light-primary hover:bg-light-primary-fixed hover:text-light-on-surface text-white px-8 py-2.5 rounded-soft font-semibold font-inter transition-colors shadow-sm">Perbarui SKU</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
