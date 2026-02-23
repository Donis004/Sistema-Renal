<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comidas', function (Blueprint $table) {
            $table->id('id_comida');
            $table->unsignedBigInteger('id_paciente');
            $table->enum('tipo_registro', ['FOTO', 'MANUAL'])->nullable();
            $table->timestamp('fecha_hora')->useCurrent();
            $table->timestamps();

            $table->foreign('id_paciente')
                ->references('id_paciente')
                ->on('pacientes')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comidas');
    }
};
