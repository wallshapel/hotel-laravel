<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Reservation;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
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

        foreach ($rooms as $room) {
            // Probabilidad de asignar una reservación a una habitación
            if ($faker->boolean(40)) {
                $checkIn = $faker->dateTimeBetween('-30 days', '+30 days');
                $checkOut = $faker->dateTimeBetween($checkIn, '+30 days');

                Reservation::create([
                    'room_id' => $room->id,
                    'check_in_date' => $checkIn,
                    'check_out_date' => $checkOut,
                ]);
            }
        }
    }
}
