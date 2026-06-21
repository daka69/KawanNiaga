<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Fungsi helper untuk mencari key yang cocok
        $findKey = function(array $possibleKeys) use ($row) {
            foreach ($possibleKeys as $key) {
                if (isset($row[$key]) && $row[$key] !== '') {
                    return $row[$key];
                }
            }
            return null;
        };

        $name = $findKey(['nama_produk', 'nama', 'name', 'produk']);
        
        // Skip jika nama kosong (mungkin baris kosong)
        if (empty($name)) {
            return null;
        }

        return new Product([
            'name'          => $name,
            'category'      => $findKey(['kategori', 'category', 'tipe']) ?? 'Umum',
            'description'   => $findKey(['deskripsi', 'description', 'keterangan', 'ket']),
            'stock'         => (int) ($findKey(['stok', 'stock', 'qty', 'jumlah']) ?? 0),
            'capital_price' => (int) ($findKey(['harga_modal', 'modal', 'capital_price', 'beli']) ?? 0),
            'selling_price' => (int) ($findKey(['harga_jual', 'jual', 'selling_price', 'harga']) ?? 0),
        ]);
    }
}
