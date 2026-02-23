<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registro_sintomas', function (Blueprint $table) {
            $table->id('id_registro');
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_sintoma');
            $table->enum('intensidad', ['LEVE', 'MODERADO', 'SEVERO'])->nullable();
            $table->timestamp('fecha_hora')->useCurrent();
            $table->timestamps();

            $table->foreign('id_paciente')
                ->references('id_paciente')
                ->on('pacientes')
                ->onDelete('cascade');

            $table->foreign('id_sintoma')
                ->references('id_sintoma')
                ->on('sintomas')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registro_sintomas');
    }
};
