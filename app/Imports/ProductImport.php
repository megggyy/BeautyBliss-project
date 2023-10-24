<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithValidation, WithHeadingRow
{
    public function model(array $row)
    {
        $product = new Product([
            'category_id' => $row['category_id'],
            'name' => $row['name'],
            'slug' => Str::slug($row['slug']),
            'brand' => $row['brand'],
            'small_description' => $row['small_description'],
            'description' => $row['description'],
            'original_price' => $row['original_price'],
            'selling_price' => $row['selling_price'],
            'quantity' => $row['quantity'],
            'trending' => $row['trending'] == '1' ? '1' : '0',
            'status' => $row['status'] == '1' ? '1' : '0',
        ]);

        $productImages = [];
        if ($row['images']) {
            $imageFilenames = explode(',', $row['images']);
            foreach ($imageFilenames as $filename) {
                $productImages[] = new ProductImage(['image' => $filename]);
            }
        }

        $productColors = [];
        if ($row['shades']) {
            $shades = explode(',', $row['shades']);
            foreach ($shades as $shade) {
                $color = Color::firstOrCreate(['name' => $shade]);
                $productColors[] = new ProductColor([
                    'color_id' => $color->id,
                    'quantity' => $row['quantity'] // Set the quantity for each color
                ]);
            }
        }

        $product->save(); // Save the product first to get the product ID

        foreach ($productImages as $productImage) {
            $product->productImages()->save($productImage);
        }

        foreach ($productColors as $productColor) {
            $product->productColors()->save($productColor);
        }

        return $product;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'slug' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'small_description' => ['required', 'string'],
            'description' => ['required', 'string'],
            'original_price' => ['nullable', 'integer'],
            'selling_price' => ['nullable', 'integer'],
            'quantity' => ['required', 'integer'],
            'trending' => ['nullable'],
            'status' => ['nullable'],
            'images' => ['nullable'], // Add validation rule for images column
            'shades' => ['nullable'], // Add validation rule for shades column
        ];
    }
}
