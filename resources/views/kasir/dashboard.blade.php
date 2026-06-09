<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Point of Sales (Kasir)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-xl mb-6 shadow-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-500 text-white p-4 rounded-xl mb-6 shadow-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="glass p-8 rounded-2xl shadow-2xl">
                <h3 class="text-2xl font-extrabold text-gray-800 dark:text-white mb-6">Proses Transaksi Baru</h3>
                
                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Pilih Produk</label>
                        <select name="product_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white dark:bg-gray-700 dark:text-white p-3" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}">{{ $p->name }} - Rp {{ number_format($p->selling_price, 0, ',', '.') }} (Stok: {{ $p->stock }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Jumlah (Qty)</label>
                        <input type="number" name="quantity" min="1" value="1" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white dark:bg-gray-700 dark:text-white p-3" required>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-green-400 to-blue-500 text-white font-bold py-4 rounded-xl hover-scale shadow-lg text-lg">
                        Selesaikan Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
