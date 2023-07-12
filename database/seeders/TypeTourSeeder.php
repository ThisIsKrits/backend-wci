<?php

namespace Database\Seeders;

use App\Models\TypeTour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeTourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            ['name' => 'domestik'],
            ['name' => 'international'],
        ];

        foreach ($type as $key => $value) {
            TypeTour::create($value);
        }
    }
}
