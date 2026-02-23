<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paciente_medicamentos', function (Blueprint $table) {
            $table->id('id_pm');
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_medicamento');
            $table->string('dosis', 50)->nullable();
            $table->string('frecuencia', 50)->nullable();
            $table->boolean('con_alimentos')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->foreign('id_paciente')
                ->references('id_paciente')
                ->on('pacientes')
                ->onDelete('cascade');

            $table->foreign('id_medicamento')
                ->references('id_medicamento')
                ->on('medicamentos')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paciente_medicamentos');
    }
};
