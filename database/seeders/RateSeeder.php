<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rate;
use App\Models\Hotel;
use App\Models\Season;

class RateSeeder extends Seeder
{
    public function run()
    {
        // Obtener los hoteles y temporadas
        $barranquilla = Hotel::where('name', 'Barranquilla')->first();
        $cali = Hotel::where('name', 'Cali')->first();
        $cartagena = Hotel::where('name', 'Cartagena')->first();
        $bogota = Hotel::where('name', 'Bogotá')->first();
        
        $altaSeason = Season::where('name', 'Alta')->first();
        $bajaSeason = Season::where('name', 'Baja')->first();
        
        // Rates para Barranquilla
        Rate::create([
            'hotel_id' => $barranquilla->id,
            'season_id' => $altaSeason->id,
            'room_type' => 'standard',
            'number_of_people' => 1,
            'price' => 100.00,
        ]);

        Rate::create([
            'hotel_id' => $barranquilla->id,
            'season_id' => $altaSeason->id,
            'room_type' => 'premium',
            'number_of_people' => 1,
            'price' => 150.00,
        ]);

        Rate::create([
            'hotel_id' => $barranquilla->id,
            'season_id' => $bajaSeason->id,
            'room_type' => 'standard',
            'number_of_people' => 1,
            'price' => 80.00,
        ]);

        Rate::create([
            'hotel_id' => $barranquilla->id,
            'season_id' => $bajaSeason->id,
            'room_type' => 'premium',
            'number_of_people' => 1,
            'price' => 120.00,
        ]);

        // Rates para Cali
        Rate::create([
            'hotel_id' => $cali->id,
            'season_id' => $altaSeason->id,
            'room_type' => 'premium',
            'number_of_people' => 1,
            'price' => 180.00,
        ]);

        Rate::create([
            'hotel_id' => $cali->id,
            'season_id' => $altaSeason->id,
            'room_type' => 'VIP',
            'number_of_people' => 1,
            'price' => 250.00,
        ]);

        Rate::create([
            'hotel_id' => $cali->id,
            'season_id' => $bajaSeason->id,
            'room_type' => 'premium',
            'number_of_people' => 1,
            'price' => 150.00,
        ]);

        Rate::create([
            'hotel_id' => $cali->id,
            'season_id' => $bajaSeason->id,
            'room_type' => 'VIP',
            'number_of_people' => 1,
            'price' => 220.00,
        ]);

        // Rates para Cartagena
        Rate::create([
            'hotel_id' => $cartagena->id,
            'season_id' => $altaSeason->id,
            'room_type' => 'standard',
            'number_of_people' => 1,
            'price' => 120.00,
        ]);

        Rate::create([
            'hotel_id' => $cartagena->id,
            'season_id' => $altaSeason->id,
            'room_type' => 'premium',
            'number_of_people' => 1,
            'price' => 180.00,
        ]);

        Rate::create([
            'hotel_id' => $cartagena->id,
            'season_id' => $bajaSeason->id,
            'room_type' => 'standard',
            'number_of_people' => 1,
            'price' => 100.00,
        ]);

        Rate::create([
            'hotel_id' => $cartagena->id,
            'season_id' => $bajaSeason->id,
            'room_type' => 'premium',
            'number_of_people' => 1,
            'price' => 150.00,
        ]);

        // Rates para Bogotá
        Rate::create([
            'hotel_id' => $bogota->id,
            'season_id' => $altaSeason->id,
            'room_type' => 'standard',
            'number_of_people' => 1,
            'price' => 150.00,
        ]);

        Rate::create([
            'hotel_id' => $bogota->id,
            'season_id' => $altaSeason->id,
            'room_type' => 'premium',
            'number_of_people' => 1,
            'price' => 200.00,
        ]);

        Rate::create([
            'hotel_id' => $bogota->id,
            'season_id' => $altaSeason->id,
            'room_type' => 'VIP',
            'number_of_people' => 1,
            'price' => 280.00,
        ]);

        Rate::create([
            'hotel_id' => $bogota->id,
            'season_id' => $bajaSeason->id,
            'room_type' => 'standard',
            'number_of_people' => 1,
            'price' => 120.00,
        ]);

        Rate::create([
            'hotel_id' => $bogota->id,
            'season_id' => $bajaSeason->id,
            'room_type' => 'premium',
            'number_of_people' => 1,
            'price' => 180.00,
        ]);

        Rate::create([
            'hotel_id' => $bogota->id,
            'season_id' => $bajaSeason->id,
            'room_type' => 'VIP',
            'number_of_people' => 1,
            'price' => 250.00,
        ]);
    }
}
