<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Admin - KawanNiaga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-xl mb-6 shadow-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Glassmorphism Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="glass p-6 rounded-xl hover-scale">
                    <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Total Profit Hari Ini</h3>
                    <p class="text-3xl text-green-500 font-extrabold mt-2">Rp {{ number_format($totalProfitToday, 0, ',', '.') }}</p>
                </div>
                <div class="glass p-6 rounded-xl hover-scale">
                    <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Total Omzet Hari Ini</h3>
                    <p class="text-3xl text-blue-500 font-extrabold mt-2">Rp {{ number_format($totalSalesToday, 0, ',', '.') }}</p>
                </div>
                <div class="glass p-6 rounded-xl hover-scale">
                    <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Total Katalog Produk</h3>
                    <p class="text-3xl text-purple-500 font-extrabold mt-2">{{ $productsCount }} Item</p>
                </div>
            </div>

            <!-- Low Stock Alerts -->
            @if($lowStockProducts->count() > 0)
            <div class="bg-red-500 bg-opacity-20 border border-red-500 p-6 rounded-xl glass mt-6">
                <h3 class="text-red-500 font-bold text-xl mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Peringatan Stok Menipis!
                </h3>
                <ul class="list-disc list-inside text-red-600 dark:text-red-400 font-semibold">
                    @foreach($lowStockProducts as $p)
                        <li>{{ $p->name }} (Sisa: {{ $p->stock }})</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="glass p-6 rounded-xl mt-6 text-center">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">Manajemen Inventori & Katalog</h3>
                <a href="{{ route('products.index') }}" class="inline-block bg-gradient-to-r from-purple-500 to-indigo-500 text-white font-bold py-3 px-8 rounded-full hover-scale shadow-lg">
                    Kelola Produk (CRUD & Excel)
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
