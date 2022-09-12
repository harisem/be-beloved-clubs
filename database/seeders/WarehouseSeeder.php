<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Warehouse::truncate();

        $csvFile = fopen(base_path("database/data/warehouses.csv"), "r");
        $firstLine = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstLine) {
                Warehouse::create([
                    'product_id' => $data[0],
                    'name' => $data[1],
                    'size' => $data[2],
                    'color' => $data[3],
                    'frontImg' => $data[4],
                    'backImg' => $data[5],
                    'weight' => $data[6],
                    'price' => $data[7],
                    'discount' => $data[8],
                    'ready' => $data[9]
                ]);
            }
            $firstLine = false;
        }
        fclose($csvFile);
    }
}
