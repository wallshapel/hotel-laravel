<?php

namespace App\Http\Services;

use App\Models\Room;
use App\Http\DTOs\RoomDTO;

class RoomService
{
    public function getAll()
    {
        return Room::all();
    }

    public function getById($id)
    {
        return Room::findOrFail($id);
    }

    public function create(RoomDTO $roomDTO)
    {
        return Room::create([
            'hotel_id' => $roomDTO->hotel_id,
            'type' => $roomDTO->type,
            'capacity' => $roomDTO->capacity,
            'availability' => $roomDTO->availability,
        ]);
    }

    public function update($id, RoomDTO $roomDTO)
    {
        $room = Room::findOrFail($id);
        $room->update([
            'hotel_id' => $roomDTO->hotel_id,
            'type' => $roomDTO->type,
            'capacity' => $roomDTO->capacity,
            'availability' => $roomDTO->availability,
        ]);

        return $room;
    }

    public function delete($id)
    {
        Room::findOrFail($id)->delete();
    }
}
