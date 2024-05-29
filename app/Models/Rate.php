<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = ['hotel_id', 'season_id', 'room_type', 'number_of_people', 'price'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
