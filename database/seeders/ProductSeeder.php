<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Product::truncate();

        $csvFile = fopen(base_path("database/data/products.csv"), "r");
        $firstLine = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstLine) {
                Product::create([
                    'name' => $data[0],
                    'slug' => Str::slug($data[0], '-'),
                    'image' => $data[1],
                    'content' => $data[2],
                    'stock' => $data[3]
                ]);
            }
            $firstLine = false;
        }
        fclose($csvFile);
    }
}
