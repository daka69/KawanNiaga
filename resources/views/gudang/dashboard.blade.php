<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Stok Gudang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-xl mb-6 shadow-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="glass p-8 rounded-2xl shadow-2xl">
                <h3 class="text-2xl font-extrabold text-gray-800 dark:text-white mb-6">Daftar Barang (SOH)</h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                                <th class="p-4 font-semibold">Nama Produk</th>
                                <th class="p-4 font-semibold">Kategori</th>
                                <th class="p-4 font-semibold text-center">Stok Fisik Saat Ini</th>
                                <th class="p-4 font-semibold text-center">Update Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-800 dark:text-gray-200">
                            @foreach($products as $p)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="p-4">{{ $p->name }}</td>
                                <td class="p-4">{{ $p->category }}</td>
                                <td class="p-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-lg font-bold {{ $p->stock < 10 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $p->stock }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <form action="{{ route('products.update', $p->id) }}" method="POST" class="flex gap-2 justify-center">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="stock" value="{{ $p->stock }}" class="w-24 rounded-lg border-gray-300 text-center" min="0" required>
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded-lg shadow-md">Simpan</button>
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
</x-app-layout>
