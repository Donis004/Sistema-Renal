<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicamentoSeeder extends Seeder
{
    public function run(): void
    {
        $medicamentos = [
            ['nombre' => 'Losartán'],
            ['nombre' => 'Enalapril'],
            ['nombre' => 'Amlodipino'],
            ['nombre' => 'Furosemida'],
            ['nombre' => 'Hidroclorotiazida'],
            ['nombre' => 'Metformina'],
            ['nombre' => 'Insulina'],
            ['nombre' => 'Atorvastatina'],
            ['nombre' => 'Omeprazol'],
            ['nombre' => 'Alopurinol'],
            ['nombre' => 'Sevelámero'],
            ['nombre' => 'Carbonato de calcio'],
            ['nombre' => 'Eritropoyetina'],
            ['nombre' => 'Vitamina D'],
            ['nombre' => 'Ácido fólico'],
        ];

        DB::table('medicamentos')->insert($medicamentos);
    }
}
