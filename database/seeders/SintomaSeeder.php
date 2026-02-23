<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SintomaSeeder extends Seeder
{
    public function run(): void
    {
        $sintomas = [
            ['nombre' => 'Fatiga'],
            ['nombre' => 'Náuseas'],
            ['nombre' => 'Vómitos'],
            ['nombre' => 'Pérdida de apetito'],
            ['nombre' => 'Hinchazón en piernas'],
            ['nombre' => 'Dificultad para respirar'],
            ['nombre' => 'Orina espuma'],
            ['nombre' => 'Cambios en la micción'],
            ['nombre' => 'Dolor de cabeza'],
            ['nombre' => 'Mareos'],
            ['nombre' => 'Calambres musculares'],
            ['nombre' => 'Picazón en la piel'],
            ['nombre' => 'Sequedad de boca'],
            ['nombre' => 'Mal aliento'],
            ['nombre' => 'Confusión'],
        ];

        DB::table('sintomas')->insert($sintomas);
    }
}
