<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paciente_comorbilidad', function (Blueprint $table) {
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_comorbilidad');
            $table->primary(['id_paciente', 'id_comorbilidad']);
            $table->timestamps();

            $table->foreign('id_paciente')
                ->references('id_paciente')
                ->on('pacientes')
                ->onDelete('cascade');

            $table->foreign('id_comorbilidad')
                ->references('id_comorbilidad')
                ->on('comorbilidades')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paciente_comorbilidad');
    }
};
