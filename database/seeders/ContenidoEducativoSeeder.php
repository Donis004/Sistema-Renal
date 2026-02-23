<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContenidoEducativoSeeder extends Seeder
{
    public function run(): void
    {
        $contenidos = [
            ['titulo' => 'Dietas para ERC Temprana', 'etapa_erc' => '1', 'tipo' => 'DIETA', 'contenido' => 'En las etapas tempranas de la enfermedad renal cronica, es importante mantener una dieta equilibrada. Limite el consumo de proteinas a 0.8g por kg de peso corporal. Reduzca la ingesta de sodio a menos de 2,300mg diarios. Beba suficiente agua.'],
            ['titulo' => 'Control de Presion Arterial', 'etapa_erc' => '1', 'tipo' => 'EJERCICIO', 'contenido' => 'Mantenga su presion arterial por debajo de 130/80 mmHg. Realice ejercicio moderado regularmente. Reduzca el consumo de sal.'],
            ['titulo' => 'Nutricion en ERC Estadio 3', 'etapa_erc' => '3a', 'tipo' => 'DIETA', 'contenido' => 'En etapa 3, limite las proteinas a 0.6-0.8g por kg. Reduzca el potasio a 2,000-3,000mg diarios. Limite el fosforo a 800-1,000mg. Controle el consumo de sodio.'],
            ['titulo' => 'Importancia del EGFR', 'etapa_erc' => '3a', 'tipo' => 'DIETA', 'contenido' => 'El EGFR (tasa de filtracion glomerular estimada) indica que tan bien funcionan sus rinones. Un EGFR menor a 60 significa enfermedad renal. Controle sus analisis regularmente.'],
            ['titulo' => 'Dieta para ERC Avanzada', 'etapa_erc' => '4', 'tipo' => 'DIETA', 'contenido' => 'En etapas avanzadas, limite proteinas a 0.6g por kg. Restrinja potasio a menos de 2,000mg. Limite fosforo a 800mg. Reduzca liquidos segun indicacion medica.'],
            ['titulo' => 'Preparacion para Dialisis', 'etapa_erc' => '4', 'tipo' => 'DIETA', 'contenido' => 'Si se acerca a la dialisis, es importante mantener una buena nutricion. Consulte con un nefrologo y nutricionista sobre las opciones de tratamiento.'],
            ['titulo' => 'Control de Liquidos', 'etapa_erc' => '3a', 'tipo' => 'LIQUIDOS', 'contenido' => 'El exceso de liquidos puede causar hinchazon y presion arterial alta. Lleve un registro de su consumo de liquidos. Incluya hielo, sopa y frutas con alto contenido de agua.'],
            ['titulo' => 'Senales de Retencion de Liquidos', 'etapa_erc' => '3b', 'tipo' => 'LIQUIDOS', 'contenido' => 'Este atento a la hinchazon en tobillos, pies y manos. El aumento rapido de peso puede indicar retencion de liquidos. La falta de aire puede ser una senal de liquido en los pulmones.'],
            ['titulo' => 'Ejercicio y ERC', 'etapa_erc' => '1', 'tipo' => 'EJERCICIO', 'contenido' => 'El ejercicio regular ayuda a controlar la presion arterial y el peso. Comience gradualmente. Camine 30 minutos diarios. Siempre consulte a su medico antes de iniciar un programa de ejercicios.'],
            ['titulo' => 'Manejo del Estres', 'etapa_erc' => '1', 'tipo' => 'EJERCICIO', 'contenido' => 'El estres puede empeorar la enfermedad renal. Practique tecnicas de relajacion. Mantenga una red de apoyo. Duerma adecuadamente.'],
        ];

        DB::table('contenidos_educativos')->insert($contenidos);
    }
}
