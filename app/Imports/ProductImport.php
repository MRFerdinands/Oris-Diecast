<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $existingProduct = Product::where('kode_product', $row[0])->first();

        if ($existingProduct) {
            return null;
        }

        return new Product([
            'kode_product' => $row[0],
            'nama_product' => $row[1],
            'harga_beli' => $row[2],
            'harga_jual' => $row[3],
        ]);
    }
}