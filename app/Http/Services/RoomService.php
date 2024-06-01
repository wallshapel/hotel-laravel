<?php

namespace App\Http\Services;

use App\Models\Room;
use App\Models\Reservation;
use App\Models\RoomRate;
use App\Models\Season;
use Carbon\Carbon;

class RoomService
{

    public function getAvailableRooms($checkInDate, $checkOutDate)
    {
        // Parse dates
        $checkInDate = Carbon::parse($checkInDate);
        $checkOutDate = Carbon::parse($checkOutDate);

        // Get occupied room ids
        $occupiedRoomIds = Reservation::where(function ($query) use ($checkInDate, $checkOutDate) {
            $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                    $query->where('check_in_date', '<', $checkInDate)
                        ->where('check_out_date', '>', $checkOutDate);
                });
        })->pluck('room_id');

        // Get available rooms
        $availableRooms = Room::with(['hotel', 'roomType', 'roomRates' => function ($query) {
            $query->with('season');
        }])
            ->whereNotIn('id', $occupiedRoomIds)
            ->get();

        // Transform data
        $availableRooms = $availableRooms->map(function ($room) {
            $roomData = [
                'hotel' => $room->hotel->name,
                'hotel_locality' => $room->hotel->location,
                'room' => $room->roomType->type,
                'room_code' => $room->code,
                'room_capacity' => $room->capacity,
                'room_prices' => []
            ];

            // Group rates by season
            $ratesBySeason = collect($room->roomRates)->groupBy('season.name');

            // Add prices for each season
            foreach ($ratesBySeason as $seasonName => $seasonRates) {
                foreach ($seasonRates as $rate) {
                    $roomData['room_prices'][] = [
                        'season' => $seasonName,
                        'start_date' => $rate->season->start_date,
                        'end_date' => $rate->season->end_date,
                        'value' => $rate->price
                    ];
                }
            }

            return $roomData;
        });

        return $availableRooms;
    }

    /**
     * Calcular la tarifa a cancelar de acuerdo a los parámetros dados.
     *
     * @param string $roomCode Código único de la habitación.
     * @param string $seasonName Nombre de la temporada.
     * @param string $checkInDate Fecha de entrada.
     * @param string $checkOutDate Fecha de salida.
     * @param int $numberOfPeople Número de personas.
     * @return float|null Tarifa a cancelar o null si hay errores.
     */
    public function calculateCancellationRate($roomCode, $seasonName, $checkinDate, $checkoutDate, $numPeople)
    {

        try {
            // Obtener la habitación por código
            $room = Room::where('code', $roomCode)->firstOrFail();

            // Validar que el número de personas sea menor o igual a la capacidad de la habitación
            if ($numPeople > $room->capacity)
                throw new \Exception('El número de personas excede la capacidad de la habitación.');
            
            // Obtener la temporada por nombre
            $season = Season::where('name', $seasonName)->firstOrFail();
            
            // Obtener la tarifa de la habitación para la temporada especificada
            $roomRate = RoomRate::where('room_id', $room->id)
                                ->where('season_id', $season->id)
                                ->firstOrFail();

            // Calcular los días de estancia
            $checkin = new \DateTime($checkinDate);
            $checkout = new \DateTime($checkoutDate);
            $interval = $checkin->diff($checkout);
            $days = $interval->days;

            // Calcular el costo total
            $totalCost = $roomRate->price * $numPeople * $days;

            return $totalCost;
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
