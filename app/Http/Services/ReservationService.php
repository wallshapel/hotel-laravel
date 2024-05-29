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
}
