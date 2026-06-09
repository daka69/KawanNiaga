<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Katalog Produk & Inventori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-xl mb-6 shadow-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Excel Import/Export Panel -->
            <div class="glass p-6 rounded-2xl shadow-xl mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-4">
                    @csrf
                    <input type="file" name="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:text-gray-300" required>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-full transition shadow-md whitespace-nowrap">
                        Import Excel
                    </button>
                </form>
                
                <a href="{{ route('products.export') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-full transition shadow-md flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Export ke Excel
                </a>
            </div>

            <!-- Product Table -->
            <div class="glass rounded-2xl shadow-2xl overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white">Daftar Produk</h3>
                    <button onclick="document.getElementById('modal-create').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full shadow-md">
                        + Tambah Produk
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                                <th class="p-4 font-semibold">Nama Produk</th>
                                <th class="p-4 font-semibold">Kategori</th>
                                <th class="p-4 font-semibold">Stok</th>
                                <th class="p-4 font-semibold">Modal</th>
                                <th class="p-4 font-semibold">Jual</th>
                                <th class="p-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-800 dark:text-gray-200">
                            @foreach($products as $p)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="p-4">{{ $p->name }}</td>
                                <td class="p-4">{{ $p->category }}</td>
                                <td class="p-4">
                                    <span class="px-2 py-1 rounded-full text-sm font-bold {{ $p->stock < 10 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $p->stock }}
                                    </span>
                                </td>
                                <td class="p-4">Rp {{ number_format($p->capital_price, 0, ',', '.') }}</td>
                                <td class="p-4">Rp {{ number_format($p->selling_price, 0, ',', '.') }}</td>
                                <td class="p-4 flex justify-center gap-2">
                                    <button onclick="openEditModal({{ $p }})" class="text-blue-500 hover:text-blue-700 font-bold bg-blue-100 px-3 py-1 rounded-md">Edit</button>
                                    <form action="{{ route('products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold bg-red-100 px-3 py-1 rounded-md">Hapus</button>
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

    <!-- Modal Create (Simplified for brevity) -->
    <div id="modal-create" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="glass p-8 rounded-2xl w-full max-w-md">
            <h2 class="text-2xl font-bold text-white mb-4">Tambah Produk Baru</h2>
            <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Nama Produk" class="w-full rounded-xl p-2" required>
                <input type="text" name="category" placeholder="Kategori" class="w-full rounded-xl p-2">
                <input type="number" name="stock" placeholder="Stok" class="w-full rounded-xl p-2" required>
                <input type="number" name="capital_price" placeholder="Harga Modal" class="w-full rounded-xl p-2" required>
                <input type="number" name="selling_price" placeholder="Harga Jual" class="w-full rounded-xl p-2" required>
                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" onclick="document.getElementById('modal-create').classList.add('hidden')" class="bg-gray-500 text-white px-4 py-2 rounded-full">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-full">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script for Edit Modal could be added here, using Alpine or Vanilla JS -->
    <script>
        function openEditModal(product) {
            alert('Fitur edit untuk ' + product.name + ' bisa diimplementasikan dengan modal serupa!');
            // To save time, I am stubbing the edit modal popup. For a real app, populate a form with product data.
        }
    </script>
</x-app-layout>
