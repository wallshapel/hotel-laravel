<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Hotel;
use Illuminate\Support\Str;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // IDs de los tipos de habitación
        $standardTypeId = 1;
        $premiumTypeId = 2;
        $vipTypeId = 3;

        // IDs de los hoteles
        $hotelEstelarPradoId = 1;
        $hotelSpiwakCaliId = 2;
        $hotelCapillaMarId = 3;
        $hotelJWMarriottBogotaId = 4;

        // Crear 30 habitaciones estándar para Hotel Estelar Alto Prado
        $this->createRooms($hotelEstelarPradoId, $standardTypeId, 30, 4);

        // Crear 3 habitaciones premium para Hotel Estelar Alto Prado
        $this->createRooms($hotelEstelarPradoId, $premiumTypeId, 3, 4);

        // Crear 20 habitaciones premium para Hotel Spiwak Chipichape Cali
        $this->createRooms($hotelSpiwakCaliId, $premiumTypeId, 20, 6);

        // Crear 2 habitaciones VIP para Hotel Spiwak Chipichape Cali
        $this->createRooms($hotelSpiwakCaliId, $vipTypeId, 2, 6);

        // Crear 10 habitaciones estándar para Hotel Capilla del Mar
        $this->createRooms($hotelCapillaMarId, $standardTypeId, 10, 8);

        // Crear 1 habitación premium para Hotel Capilla del Mar
        $this->createRooms($hotelCapillaMarId, $premiumTypeId, 1, 8);

        // Crear 20 habitaciones estándar para JW Marriott Hotel Bogotá
        $this->createRooms($hotelJWMarriottBogotaId, $standardTypeId, 20, 6);

        // Crear 20 habitaciones premium para JW Marriott Hotel Bogotá
        $this->createRooms($hotelJWMarriottBogotaId, $premiumTypeId, 20, 6);

        // Crear 2 habitaciones VIP para JW Marriott Hotel Bogotá
        $this->createRooms($hotelJWMarriottBogotaId, $vipTypeId, 2, 6);
    }

    /**
     * Crear habitaciones con los parámetros especificados.
     *
     * @param int $hotelId
     * @param int $roomTypeId
     * @param int $quantity
     * @param int $capacity
     * @return void
     */
    private function createRooms($hotelId, $roomTypeId, $quantity, $capacity)
    {
        $hotel = Hotel::find($hotelId);
        $roomType = RoomType::find($roomTypeId);

        for ($i = 1; $i <= $quantity; $i++) {
            $code = $this->generateUniqueRoomCode();
            Room::create([
                'code' => $code,
                'hotel_id' => $hotelId,
                'room_type_id' => $roomTypeId,
                'capacity' => $capacity,
            ]);
        }
    }

    /**
     * Generar un código único para la habitación.
     *
     * @return string
     */
    private function generateUniqueRoomCode()
    {
        $code = '';
        do {
            $code = 'ROOM' . strtoupper(Str::random(6));
        } while (Room::where('code', $code)->exists());

        return $code;
    }
}
