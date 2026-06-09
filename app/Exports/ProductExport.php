<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::select('id', 'name', 'category', 'stock', 'capital_price', 'selling_price')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama Produk', 'Kategori', 'Stok', 'Harga Modal', 'Harga Jual'];
    }
}
