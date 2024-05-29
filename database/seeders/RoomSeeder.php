<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Hotel;

class RoomSeeder extends Seeder
{
    public function run()
    {
        // Barranquilla
        $barranquilla = Hotel::where('name', 'Barranquilla')->first();
        Room::create([
            'hotel_id' => $barranquilla->id,
            'type' => 'standard',
            'max_capacity' => 4,
            'quantity' => 30,
        ]);

        Room::create([
            'hotel_id' => $barranquilla->id,
            'type' => 'premium',
            'max_capacity' => 4,
            'quantity' => 3,
        ]);

        // Cali
        $cali = Hotel::where('name', 'Cali')->first();
        Room::create([
            'hotel_id' => $cali->id,
            'type' => 'premium',
            'max_capacity' => 6,
            'quantity' => 20,
        ]);

        Room::create([
            'hotel_id' => $cali->id,
            'type' => 'VIP',
            'max_capacity' => 6,
            'quantity' => 2,
        ]);

        // Cartagena
        $cartagena = Hotel::where('name', 'Cartagena')->first();
        Room::create([
            'hotel_id' => $cartagena->id,
            'type' => 'standard',
            'max_capacity' => 8,
            'quantity' => 10,
        ]);

        Room::create([
            'hotel_id' => $cartagena->id,
            'type' => 'premium',
            'max_capacity' => 8,
            'quantity' => 1,
        ]);

        // Bogotá
        $bogota = Hotel::where('name', 'Bogotá')->first();
        Room::create([
            'hotel_id' => $bogota->id,
            'type' => 'standard',
            'max_capacity' => 6,
            'quantity' => 20,
        ]);

        Room::create([
            'hotel_id' => $bogota->id,
            'type' => 'premium',
            'max_capacity' => 6,
            'quantity' => 20,
        ]);

        Room::create([
            'hotel_id' => $bogota->id,
            'type' => 'VIP',
            'max_capacity' => 6,
            'quantity' => 2,
        ]);
    }
}