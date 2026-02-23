<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlergiaSeeder extends Seeder
{
    public function run(): void
    {
        $alergias = [
            ['nombre' => 'Gluten'],
            ['nombre' => 'Lactosa'],
            ['nombre' => 'Frutos secos'],
            ['nombre' => 'Mariscos'],
            ['nombre' => 'Huevos'],
            ['nombre' => 'Soja'],
            ['nombre' => 'Pescado'],
            ['nombre' => 'Maní'],
            ['nombre' => 'Sulfitos'],
            ['nombre' => 'Fosfatos'],
        ];

        DB::table('alergias')->insert($alergias);
    }
}
