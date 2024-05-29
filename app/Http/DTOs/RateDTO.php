<?php

namespace App\Http\DTOs;

class RateDTO
{
    public $hotel_id;
    public $season_id;
    public $room_type;
    public $rate_per_night;

    public function __construct($hotel_id, $season_id, $room_type, $rate_per_night)
    {
        $this->hotel_id = $hotel_id;
        $this->season_id = $season_id;
        $this->room_type = $room_type;
        $this->rate_per_night = $rate_per_night;
    }

    public static function fromRequest($request)
    {
        return new self(
            $request->hotel_id,
            $request->season_id,
            $request->room_type,
            $request->rate_per_night
        );
    }
}