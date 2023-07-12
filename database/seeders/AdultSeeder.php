<?php

namespace Database\Seeders;

use App\Models\Adult;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $adults = [
            [
                'name' => 'Dewasa',
                'age'  => '> 17 Tahun'
            ],
            [
                'name' => 'Anak',
                'age'  => '0 - 16 Tahun'
            ],
        ];

        foreach ($adults as $key => $value) {
            Adult::create($value);
        }
    }
}
