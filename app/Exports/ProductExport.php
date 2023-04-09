<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = Product::all();

        $data = $products->map(function($product) {
            return [
                $product->id,
                $product->product_category,
                $product->product_group,
                $product->medicine_name,
                $product->generic_name,
                $product->strength,
            ];
        });

        // add column headers to the data
        $data->prepend([
            'ID',
            'Product Category',
            'Product Group',
            'Medicine Name',
            'Generic Name',
            'Strength',
        ]);

        return $data;
    }
}
