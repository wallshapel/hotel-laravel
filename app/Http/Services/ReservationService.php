<?php

namespace App\Http\Services;

use App\Models\Reservation;
use App\Http\DTOs\ReservationDTO;

class ReservationService
{
    public function getAll()
    {
        return Reservation::all();
    }

    public function getById($id)
    {
        return Reservation::findOrFail($id);
    }

    public function create(ReservationDTO $reservationDTO)
    {
        return Reservation::create([
            'hotel_id' => $reservationDTO->hotel_id,
            'room_id' => $reservationDTO->room_id,
            'check_in' => $reservationDTO->check_in,
            'check_out' => $reservationDTO->check_out,
            'guests' => $reservationDTO->guests,
        ]);
    }

    public function update($id, ReservationDTO $reservationDTO)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'hotel_id' => $reservationDTO->hotel_id,
            'room_id' => $reservationDTO->room_id,
            'check_in' => $reservationDTO->check_in,
            'check_out' => $reservationDTO->check_out,
            'guests' => $reservationDTO->guests,
        ]);

        return $reservation;
    }

    public function delete($id)
    {
        Reservation::findOrFail($id)->delete();
    }

    public function checkHotelAvailability($checkIn, $checkOut)
    {
        // Obtener todos los hoteles
        $hotels = Hotel::all();

        $availableHotels = [];

        foreach ($hotels as $hotel) {
            // Obtener las habitaciones disponibles para el hotel y fechas dadas
            $availableRooms = Room::where('hotel_id', $hotel->id)
                ->whereDoesntHave('reservations', function ($query) use ($checkIn, $checkOut) {
                    $query->where(function ($query) use ($checkIn, $checkOut) {
                        $query->where('check_in', '<', $checkOut)
                            ->where('check_out', '>', $checkIn);
                    });
                })
                ->get();

            // Si hay habitaciones disponibles, agregar el hotel a la lista de disponibles
            if ($availableRooms->isNotEmpty()) {
                $availableHotels[] = [
                    'hotel' => $hotel,
                    'available_rooms' => $availableRooms,
                ];
            }
        }

        return $availableHotels;
    }

    /**
     * Ver las tarifas de acuerdo al sitio, temporada, tipo de alojamiento y número de personas.
     *
     * @param string $location Sede del hotel
     * @param string $roomType Tipo de habitación (standard, premium, VIP)
     * @param int $numberOfPeople Número de personas
     * @param string $checkIn Fecha de check-in
     * @param string $checkOut Fecha de check-out
     * @return array Tarifas disponibles
     */
    public function getHotelRates($location, $roomType, $numberOfPeople, $checkIn, $checkOut)
    {
        // Obtener el hotel por la sede
        $hotel = Hotel::where('location', $location)->first();

        if (!$hotel) {
            return [];
        }

        // Obtener las tarifas disponibles según la temporada, tipo de habitación y número de personas
        $rates = Rate::where('hotel_id', $hotel->id)
            ->where('room_type', $roomType)
            ->where('number_of_people', $numberOfPeople)
            ->where('start_date', '<=', $checkIn)
            ->where('end_date', '>=', $checkOut)
            ->get();

        return $rates;
    }

}
