<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $category = Category::firstOrCreate(['name' => $row['category']]);

        return new Product([
            'name' => $row['name'],
            'price' => $row['price'],
            'stock' => $row['stock'],
            'category_id' => $category->id,
            'description' => $row['description'] ?? null,
        ]);
    }
}
