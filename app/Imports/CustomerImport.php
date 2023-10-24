<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Log;

class CustomerImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $rowIndex => $row) {
            $images = [];

            // Assuming the order of the data is: id, name, phone, pin, address, images
            if (count($row) >= 6) {
                $imageUrls = explode(',', $row[5]); // Assuming images are in the sixth column (index 5)

                foreach ($imageUrls as $imageUrl) {
                    $filename = Str::random(40) . '.' . pathinfo($imageUrl, PATHINFO_EXTENSION);

                    try {
                        $imageContent = file_get_contents($imageUrl);
                        if ($imageContent !== false) {
                            Storage::put('public/customer_images/' . $filename, $imageContent);
                            $images[] = 'customer_images/' . $filename;
                        } else {
                            Log::error('Failed to download image: ' . $imageUrl);
                        }
                    } catch (\Exception $e) {
                        Log::error('Error downloading image: ' . $e->getMessage());
                    }
                }

                $customer = new Customer([
                    'user_id' => $row[0],     // Assuming id is in the first column (index 0)
                    'name' => $row[1],        // Assuming name is in the second column (index 1)
                    'phone' => $row[2],       // Assuming phone is in the third column (index 2)
                    'pin_code' => $row[3],    // Assuming pin is in the fourth column (index 3)
                    'address' => $row[4],     // Assuming address is in the fifth column (index 4)
                    'images' => $images,
                ]);

                $customer->save();
            }
        }
    }
}
