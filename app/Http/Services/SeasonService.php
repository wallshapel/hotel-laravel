<?php

namespace App\Http\Services;

use App\Models\Season;
use App\Http\DTOs\SeasonDTO;

class SeasonService
{
    public function getAll()
    {
        return Season::all();
    }

    public function getById($id)
    {
        return Season::findOrFail($id);
    }

    public function create(SeasonDTO $seasonDTO)
    {
        return Season::create([
            'name' => $seasonDTO->name,
            'start_date' => $seasonDTO->start_date,
            'end_date' => $seasonDTO->end_date,
        ]);
    }

    public function update($id, SeasonDTO $seasonDTO)
    {
        $season = Season::findOrFail($id);
        $season->update([
            'name' => $seasonDTO->name,
            'start_date' => $seasonDTO->start_date,
            'end_date' => $seasonDTO->end_date,
        ]);

        return $season;
    }

    public function delete($id)
    {
        Season::findOrFail($id)->delete();
    }
}
