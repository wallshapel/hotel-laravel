<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'room_type_id', 'hotel_id', 'capacity'
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function roomRates()
    {
        return $this->hasMany(RoomRate::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

}
