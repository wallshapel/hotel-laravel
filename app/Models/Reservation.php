<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['hotel_id', 'start_date', 'end_date', 'room_type', 'number_of_rooms', 'number_of_people', 'total_price'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
