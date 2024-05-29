<?php

namespace App\Http\DTOs;

class HotelDTO
{
    public $name;
    public $location;
    public $max_capacity;

    public function __construct($name, $location, $max_capacity)
    {
        $this->name = $name;
        $this->location = $location;
        $this->max_capacity = $max_capacity;
    }

    public static function fromRequest($request)
    {
        return new self(
            $request->name,
            $request->location,
            $request->max_capacity
        );
    }
}
