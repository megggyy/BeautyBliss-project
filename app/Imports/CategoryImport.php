<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\Xlsx;
use Illuminate\Support\Facades\File;

class CategoryImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        
        // Convert image filenames to full paths
        $images = [];
        if ($row['images']) {
            $imageFilenames = explode(',', $row['images']);
            foreach ($imageFilenames as $filename) {
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $newFilename = time() . '_' . uniqid() . '.' . $ext;
                $this->moveImage($filename, $newFilename);
                $images[] = 'uploads/category/' . $newFilename;
            }
        }

        return new Category([
            'name' => $row['name'],
            'slug' => $row['slug'],
            'description' => $row['description'],
            'images' => $images,
            'status' => $row['status'],
        ]);
    }

    protected function moveImage($sourceFilename, $newFilename)
    {

        $sourcePath = storage_path('app/public/uploads/category/' . $sourceFilename);
        $newPath = storage_path('app/public/uploads/category/' . $newFilename);
    
        // Debugging: Print out paths
        echo "Source Path: $sourcePath<br>";
        echo "New Path: $newPath<br>";

        // Check if the source file exists before moving
        if (File::exists($sourcePath)) {
            try {
                File::move($sourcePath, $newPath);
                return true; // Successful file move
            } catch (\Exception $e) {
                // Handle the exception (log, display an error message, etc.)
                return false; // Failed to move file
            }
        }

        return false; // Source file doesn't exist
    }

    public function getReaderType(): string
    {
        return Xlsx::class;
    }
}

