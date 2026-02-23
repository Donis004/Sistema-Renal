<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recomendaciones', function (Blueprint $table) {
            $table->id('id_recomendacion');
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_profesional');
            $table->text('mensaje')->nullable();
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();

            $table->foreign('id_paciente')
                ->references('id_paciente')
                ->on('pacientes')
                ->onDelete('cascade');

            $table->foreign('id_profesional')
                ->references('id_usuario')
                ->on('usuarios')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recomendaciones');
    }
};
