<?php

namespace App\Http\Services;

use App\Models\Hotel;
use App\Http\DTOs\HotelDTO;

class HotelService
{
    public function getAll()
    {
        return Hotel::all();
    }

    public function getById($id)
    {
        return Hotel::findOrFail($id);
    }

    public function create(HotelDTO $hotelDTO)
    {
        return Hotel::create([
            'name' => $hotelDTO->name,
            'location' => $hotelDTO->location,
            'max_capacity' => $hotelDTO->max_capacity,
        ]);
    }

    public function update($id, HotelDTO $hotelDTO)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->update([
            'name' => $hotelDTO->name,
            'location' => $hotelDTO->location,
            'max_capacity' => $hotelDTO->max_capacity,
        ]);

        return $hotel;
    }

    public function delete($id)
    {
        Hotel::findOrFail($id)->delete();
    }
}
