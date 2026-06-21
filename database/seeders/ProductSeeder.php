<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data produk lama (opsional, jika ingin mengulang dari awal)
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Product::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $products = [
            [
                'name' => 'Ayam Paha Fillet 500 gram',
                'category' => 'Daging & Ayam',
                'description' => 'Potongan paha ayam tanpa tulang yang juicy dan lezat. Cocok untuk dibuat ayam teriyaki, sate, atau digoreng krispi.',
                'stock' => 50,
                'capital_price' => 25000,
                'selling_price' => 32000,
                'image' => 'https://images.pexels.com/photos/618775/pexels-photo-618775.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'name' => 'Daging Sapi Slice 500 gram',
                'category' => 'Daging & Ayam',
                'description' => 'Daging sapi iris tipis premium pilihan. Sangat pas untuk menu shabu-shabu, sukiyaki, atau yakiniku.',
                'stock' => 30,
                'capital_price' => 45000,
                'selling_price' => 55000,
                'image' => 'https://images.pexels.com/photos/19228065/pexels-photo-19228065.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'name' => 'Sayuran Beku Mix (Jagung, Wortel, Kacang Polong)',
                'category' => 'Sayuran Beku',
                'description' => 'Campuran sayuran beku praktis kaya nutrisi. Tinggal rebus atau tumis sebentar, langsung siap disajikan.',
                'stock' => 100,
                'capital_price' => 12000,
                'selling_price' => 18000,
                'image' => 'https://images.pexels.com/photos/2590742/pexels-photo-2590742.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'name' => 'Brokoli Beku Segar 500 gram',
                'category' => 'Sayuran Beku',
                'description' => 'Kuntum brokoli pilihan yang dibekukan dengan metode flash-freeze untuk menjaga vitamin dan kesegarannya.',
                'stock' => 40,
                'capital_price' => 15000,
                'selling_price' => 22000,
                'image' => 'https://images.pexels.com/photos/1367243/pexels-photo-1367243.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'name' => 'Sosis Sapi Bratwurst Original',
                'category' => 'Camilan Gurih',
                'description' => 'Sosis sapi ala Jerman dengan tekstur daging yang padat dan kulit sosis yang renyah saat dipanggang.',
                'stock' => 60,
                'capital_price' => 35000,
                'selling_price' => 45000,
                'image' => 'https://images.pexels.com/photos/4102241/pexels-photo-4102241.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'name' => 'Kentang Goreng Shoestring 1 Kg',
                'category' => 'Camilan Gurih',
                'description' => 'Kentang goreng irisan tipis memanjang yang ekstra renyah. Camilan wajib saat bersantai bersama keluarga.',
                'stock' => 85,
                'capital_price' => 22000,
                'selling_price' => 30000,
                'image' => 'https://images.pexels.com/photos/115740/pexels-photo-115740.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'name' => 'Es Krim Neapolitan 1 Liter',
                'category' => 'Es Krim',
                'description' => 'Perpaduan klasik rasa cokelat, vanila, dan stroberi dalam satu wadah. Favorit anak-anak!',
                'stock' => 25,
                'capital_price' => 28000,
                'selling_price' => 38000,
                'image' => 'https://images.pexels.com/photos/1362534/pexels-photo-1362534.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
            [
                'name' => 'Nugget Ayam Crispy 500g',
                'category' => 'Camilan Gurih',
                'description' => 'Nugget ayam dengan balutan tepung roti super renyah. Bebas pengawet buatan dan kaya protein.',
                'stock' => 8, // Sengaja sedikit untuk memperlihatkan fitur "Stok menipis"
                'capital_price' => 25000,
                'selling_price' => 35000,
                'image' => 'https://images.pexels.com/photos/60616/fried-chicken-chicken-fried-crunchy-60616.jpeg?auto=compress&cs=tinysrgb&w=800',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
