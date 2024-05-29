<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonSeeder extends Seeder
{
    public function run()
    {
        Season::create([
            'name' => 'Alta',
            'start_date' => now(),
            'end_date' => now()->addMonths(6), // Alta temporada dura 6 meses desde ahora
        ]);

        Season::create([
            'name' => 'Baja',
            'start_date' => now()->addMonths(6)->addDays(1), // Comienza un día después de la alta temporada
            'end_date' => now()->addMonths(12), // Baja temporada dura 6 meses desde la alta
        ]);
    }
}
