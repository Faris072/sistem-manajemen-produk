<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::with('category')->get()->map(function ($product) {
            return [
                'Nama Produk' => $product->name,
                'Harga' => $product->price,
                'Stok' => $product->stock,
                'Kategori' => $product->category->name,
                'Deskripsi' => $product->description,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Harga',
            'Stok',
            'Kategori',
            'Deskripsi',
        ];
    }
}
