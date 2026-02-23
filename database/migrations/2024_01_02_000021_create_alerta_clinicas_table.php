<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alerta_clinicas', function (Blueprint $table) {
            $table->id('id_alerta');
            $table->unsignedBigInteger('id_paciente');
            $table->string('tipo', 100)->nullable();
            $table->text('descripcion')->nullable();
            $table->enum('nivel', ['BAJO', 'MEDIO', 'ALTO'])->nullable();
            $table->boolean('atendida')->default(false);
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();

            $table->foreign('id_paciente')
                ->references('id_paciente')
                ->on('pacientes')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alerta_clinicas');
    }
};
