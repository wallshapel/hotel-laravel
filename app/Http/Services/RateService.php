<?php

namespace App\Http\Services;

use App\Models\Rate;
use App\Http\DTOs\RateDTO;

class RateService
{
    public function getAll()
    {
        return Rate::all();
    }

    public function getById($id)
    {
        return Rate::findOrFail($id);
    }

    public function create(RateDTO $rateDTO)
    {
        return Rate::create([
            'hotel_id' => $rateDTO->hotel_id,
            'season_id' => $rateDTO->season_id,
            'room_type' => $rateDTO->room_type,
            'rate_per_night' => $rateDTO->rate_per_night,
        ]);
    }

    public function update($id, RateDTO $rateDTO)
    {
        $rate = Rate::findOrFail($id);
        $rate->update([
            'hotel_id' => $rateDTO->hotel_id,
            'season_id' => $rateDTO->season_id,
            'room_type' => $rateDTO->room_type,
            'rate_per_night' => $rateDTO->rate_per_night,
        ]);

        return $rate;
    }

    public function delete($id)
    {
        Rate::findOrFail($id)->delete();
    }
}
