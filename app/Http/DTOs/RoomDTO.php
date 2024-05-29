<?php

namespace App\Http\DTOs;

class RoomDTO
{
    public $hotel_id;
    public $type;
    public $capacity;
    public $availability;

    public function __construct($hotel_id, $type, $capacity, $availability)
    {
        $this->hotel_id = $hotel_id;
        $this->type = $type;
        $this->capacity = $capacity;
        $this->availability = $availability;
    }

    public static function fromRequest($request)
    {
        return new self(
            $request->hotel_id,
            $request->type,
            $request->capacity,
            $request->availability
        );
    }
}