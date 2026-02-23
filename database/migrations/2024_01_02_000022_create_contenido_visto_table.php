<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contenido_visto', function (Blueprint $table) {
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_contenido');
            $table->timestamp('fecha_visto')->useCurrent();
            $table->primary(['id_paciente', 'id_contenido']);
            $table->timestamps();

            $table->foreign('id_paciente')
                ->references('id_paciente')
                ->on('pacientes')
                ->onDelete('cascade');

            $table->foreign('id_contenido')
                ->references('id_contenido')
                ->on('contenidos_educativos')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contenido_visto');
    }
};
