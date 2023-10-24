<?php

namespace App\Imports;

use App\Models\Color;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ColorImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Color([
            'name' => $row['name'], // Adjust this column name as per your Excel file
            'code' => $row['code'], // Adjust this column name as per your Excel file
            'status' => $row['status'] === 'Visible' ? '1' : '0', // Adjust this column name and mapping as per your Excel file
        ]);
    }
}
