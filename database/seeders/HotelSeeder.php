<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = [
            [
                'name' => 'Hotel Estelar Alto Prado',
                'location' => 'Barranquilla'
            ],
            [
                'name' => 'Hotel Spiwak Chipichape Cali',
                'location' => 'Cali'
            ],
            [
                'name' => 'Hotel Capilla del Mar',
                'location' => 'Cartagena'
            ],
            [
                'name' => 'JW Marriott Hotel Bogotá',
                'location' => 'Bogotá'
            ]
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
}
