<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComorbilidadSeeder extends Seeder
{
    public function run(): void
    {
        $comorbilidades = [
            ['nombre' => 'Hipertensión arterial'],
            ['nombre' => 'Diabetes mellitus'],
            ['nombre' => 'Enfermedad cardiovascular'],
            ['nombre' => 'Insuficiencia cardíaca'],
            ['nombre' => 'Enfermedad pulmonar obstructiva crónica'],
            ['nombre' => 'Hepatopatía crónica'],
            ['nombre' => 'Obesidad'],
            ['nombre' => 'Artritis reumatoide'],
            ['nombre' => 'Lupus eritematoso sistémico'],
            ['nombre' => 'Enfermedad vascular periférica'],
        ];

        DB::table('comorbilidades')->insert($comorbilidades);
    }
}
