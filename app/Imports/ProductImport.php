<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([
            'name'          => $row['nama_produk'] ?? $row['name'],
            'category'      => $row['kategori'] ?? $row['category'] ?? null,
            'stock'         => $row['stok'] ?? $row['stock'] ?? 0,
            'capital_price' => $row['harga_modal'] ?? $row['capital_price'],
            'selling_price' => $row['harga_jual'] ?? $row['selling_price'],
        ]);
    }
}
