<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TypeTour;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeTourSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(AdultSeeder::class);
        $this->call(UserSeeder::class);
    }
}
