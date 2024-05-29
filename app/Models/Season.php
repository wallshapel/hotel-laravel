<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_date', 'end_date'];

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
