<?php

namespace App\Http\DTOs;

class ReservationDTO
{
    public $hotel_id;
    public $room_id;
    public $check_in;
    public $check_out;
    public $guests;

    public function __construct($hotel_id, $room_id, $check_in, $check_out, $guests)
    {
        $this->hotel_id = $hotel_id;
        $this->room_id = $room_id;
        $this->check_in = $check_in;
        $this->check_out = $check_out;
        $this->guests = $guests;
    }

    public static function fromRequest($request)
    {
        return new self(
            $request->hotel_id,
            $request->room_id,
            $request->check_in,
            $request->check_out,
            $request->guests
        );
    }
}
