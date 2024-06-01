<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seassons = [
            [
                'name' => 'Baja',
                'start_date' => '2024-01-01',
                'end_date' => '2024-06-30'
            ],
            [
                'name' => 'Alta',
                'start_date' => '2024-07-01',
                'end_date' => '2024-12-31'
            ]
        ];

        foreach ($seassons as $seasson) {
            Season::create($seasson);
        }
    }
}
