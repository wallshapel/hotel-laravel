<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    public function run()
    {
        Hotel::create([
            'name' => 'Barranquilla',
            'location' => 'Barranquilla, Colombia',
            'max_capacity' => 4,
        ]);

        Hotel::create([
            'name' => 'Cali',
            'location' => 'Cali, Colombia',
            'max_capacity' => 6,
        ]);

        Hotel::create([
            'name' => 'Cartagena',
            'location' => 'Cartagena, Colombia',
            'max_capacity' => 8,
        ]);

        Hotel::create([
            'name' => 'Bogotá',
            'location' => 'Bogotá, Colombia',
            'max_capacity' => 6,
        ]);
    }
}
