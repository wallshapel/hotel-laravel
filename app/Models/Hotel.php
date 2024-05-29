<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'max_capacity'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
