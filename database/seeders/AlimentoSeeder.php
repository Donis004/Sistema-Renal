<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlimentoSeeder extends Seeder
{
    public function run(): void
    {
        $alimentos = [
            // Frutas bajas en potasio
            ['nombre' => 'Manzana', 'potasio_mg' => 107, 'fosforo_mg' => 11, 'sodio_mg' => 1, 'proteina_g' => 0.25, 'porcion_estandar' => '1 mediana', 'seguro_renal' => true],
            ['nombre' => 'Uvas', 'potasio_mg' => 151, 'fosforo_mg' => 15, 'sodio_mg' => 2, 'proteina_g' => 0.72, 'porcion_estandar' => '1 taza', 'seguro_renal' => true],
            ['nombre' => 'Arándanos', 'potasio_mg' => 77, 'fosforo_mg' => 12, 'sodio_mg' => 1, 'proteina_g' => 0.74, 'porcion_estandar' => '1 taza', 'seguro_renal' => true],
            ['nombre' => 'Piña', 'potasio_mg' => 180, 'fosforo_mg' => 13, 'sodio_mg' => 2, 'proteina_g' => 0.89, 'porcion_estandar' => '1 taza', 'seguro_renal' => true],
            
            // Verduras bajas en potasio
            ['nombre' => 'Coliflor', 'potasio_mg' => 176, 'fosforo_mg' => 44, 'sodio_mg' => 30, 'proteina_g' => 1.92, 'porcion_estandar' => '1 taza', 'seguro_renal' => true],
            ['nombre' => 'Pepino', 'potasio_mg' => 76, 'fosforo_mg' => 24, 'sodio_mg' => 2, 'proteina_g' => 0.52, 'porcion_estandar' => '1/2 taza', 'seguro_renal' => true],
            ['nombre' => 'Lechuga', 'potasio_mg' => 70, 'fosforo_mg' => 10, 'sodio_mg' => 14, 'proteina_g' => 0.50, 'porcion_estandar' => '1 taza', 'seguro_renal' => true],
            ['nombre' => 'Cebolla', 'potasio_mg' => 116, 'fosforo_mg' => 29, 'sodio_mg' => 3, 'proteina_g' => 1.20, 'porcion_estandar' => '1/2 taza', 'seguro_renal' => true],
            
            // Proteínas
            ['nombre' => 'Pechuga de pollo', 'potasio_mg' => 256, 'fosforo_mg' => 196, 'sodio_mg' => 74, 'proteina_g' => 31.00, 'porcion_estandar' => '100g', 'seguro_renal' => true],
            ['nombre' => 'Huevo', 'potasio_mg' => 63, 'fosforo_mg' => 86, 'sodio_mg' => 62, 'proteina_g' => 6.00, 'porcion_estandar' => '1 grande', 'seguro_renal' => true],
            ['nombre' => 'Pescado blanco', 'potasio_mg' => 200, 'fosforo_mg' => 180, 'sodio_mg' => 50, 'proteina_g' => 20.00, 'porcion_estandar' => '100g', 'seguro_renal' => true],
            
            // Lácteos (controlados)
            ['nombre' => 'Leche descremada', 'potasio_mg' => 382, 'fosforo_mg' => 250, 'sodio_mg' => 103, 'proteina_g' => 8.00, 'porcion_estandar' => '1 taza', 'seguro_renal' => false],
            ['nombre' => 'Queso fresco', 'potasio_mg' => 75, 'fosforo_mg' => 159, 'sodio_mg' => 400, 'proteina_g' => 7.00, 'porcion_estandar' => '30g', 'seguro_renal' => false],
            
            // Alta en potasio (evitar)
            ['nombre' => 'Plátano', 'potasio_mg' => 422, 'fosforo_mg' => 22, 'sodio_mg' => 1, 'proteina_g' => 1.09, 'porcion_estandar' => '1 mediano', 'seguro_renal' => false],
            ['nombre' => 'Papa', 'potasio_mg' => 1619, 'fosforo_mg' => 108, 'sodio_mg' => 21, 'proteina_g' => 8.46, 'porcion_estandar' => '1 grande', 'seguro_renal' => false],
            ['nombre' => 'Tomate', 'potasio_mg' => 292, 'fosforo_mg' => 29, 'sodio_mg' => 6, 'proteina_g' => 1.35, 'porcion_estandar' => '1 mediano', 'seguro_renal' => false],
            ['nombre' => 'Naranja', 'potasio_mg' => 237, 'fosforo_mg' => 18, 'sodio_mg' => 1, 'proteina_g' => 1.23, 'porcion_estandar' => '1 mediana', 'seguro_renal' => false],
            
            // Otros
            ['nombre' => 'Arroz blanco', 'potasio_mg' => 35, 'fosforo_mg' => 25, 'sodio_mg' => 1, 'proteina_g' => 2.70, 'porcion_estandar' => '1 taza cocido', 'seguro_renal' => true],
            ['nombre' => 'Pasta', 'potasio_mg' => 24, 'fosforo_mg' => 36, 'sodio_mg' => 1, 'proteina_g' => 7.00, 'porcion_estandar' => '1 taza cocida', 'seguro_renal' => true],
            ['nombre' => 'Pan blanco', 'potasio_mg' => 24, 'fosforo_mg' => 26, 'sodio_mg' => 110, 'proteina_g' => 2.70, 'porcion_estandar' => '1 rebanada', 'seguro_renal' => true],
            ['nombre' => 'Mantequilla', 'potasio_mg' => 3, 'fosforo_mg' => 3, 'sodio_mg' => 91, 'proteina_g' => 0.09, 'porcion_estandar' => '1 cuchara', 'seguro_renal' => true],
        ];

        DB::table('alimentos')->insert($alimentos);
    }
}
