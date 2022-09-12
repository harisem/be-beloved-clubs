<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'image' => 'N4N2JKtXVTJvCzeTQHXWV0fFq5Mj0W8O7F1APzH9.png',
            'title' => 'Winter Collection',
            'description' => '<p>DON\'T COMPROMISE ON STYLE! GET FLAT <b>30%</b> OFF FOR NEW ARRIVAL.<br></p>',
            'bg' => 'DFF9F9'
        ]);
        Slider::create([
            'image' => 'ZAZIoko9jxejYB709Gz97Vtfz4gA1jM7jlcK3YvV.png',
            'title' => 'Summer Collection',
            'description' => '<p>DON\'T COMPROMISE ON STYLE! GET FLAT <b>30%</b> OFF FOR NEW ARRIVAL.<br></p>',
            'bg' => 'FDF7E3'
        ]);
        Slider::create([
            'image' => 'oaHYiYqA6TzcEHV94yI3RPcQF34XAombMbC9sYTQ.png',
            'title' => 'Loungewear Love',
            'description' => '<p>DON\'T COMPROMISE ON STYLE! GET FLAT <b>30%</b> OFF FOR NEW ARRIVAL.<br></p>',
            'bg' => 'E3D4D4'
        ]);
    }
}
