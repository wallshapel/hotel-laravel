<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Season;
use App\Models\RoomRate;
use Faker\Factory as Faker;

class RoomRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $rooms = Room::all();
        $seasons = Season::all();

        foreach ($rooms as $room) {
            $priceLow = $faker->randomFloat(2, 50, 200); // Precio en temporada baja
            $priceHigh = $priceLow + $faker->randomFloat(2, 50, 200); // Precio en temporada alta

            foreach ($seasons as $season) {
                // Asegurarse que el precio en temporada alta sea mayor que en temporada baja
                $price = ($season->name == 'Alta') ? $priceHigh : $priceLow;

                RoomRate::create([
                    'room_id' => $room->id,
                    'season_id' => $season->id,
                    'price' => $price,
                ]);
            }
        }
    }
}
