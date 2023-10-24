<?php

namespace App\Imports;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class BrandImport implements ToModel, WithValidation, WithHeadingRow
{
    public function model(array $row)
{
    $brandImages = [];
    if ($row['images']) {
        $imageFilenames = explode(',', $row['images']);
        foreach ($imageFilenames as $filename) {
            $brandImages[] = 'brands/' . $filename;
        }
    }

    return new Brand([
        'name' => $row['name'],
        'slug' => Str::slug($row['slug']),
        'status' => $row['status'] == '1' ? '1' : '0',
        'category_id' => $row['category_id'],
        'images' => $brandImages,
    ]);
}

public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'slug' => ['required', 'string', 'max:255'],
            'status' => ['nullable'],
            'category_id' => ['required', 'integer'],
            'images' => ['nullable'], // Add validation rule for images column
        ];
    }

}
