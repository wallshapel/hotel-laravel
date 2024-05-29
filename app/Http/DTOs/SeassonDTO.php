<?php

namespace App\Http\DTOs;

class SeasonDTO
{
    public $name;
    public $start_date;
    public $end_date;

    public function __construct($name, $start_date, $end_date)
    {
        $this->name = $name;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public static function fromRequest($request)
    {
        return new self(
            $request->name,
            $request->start_date,
            $request->end_date
        );
    }
}
