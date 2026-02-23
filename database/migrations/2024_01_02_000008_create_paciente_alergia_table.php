<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paciente_alergia', function (Blueprint $table) {
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_alergia');
            $table->primary(['id_paciente', 'id_alergia']);
            $table->timestamps();

            $table->foreign('id_paciente')
                ->references('id_paciente')
                ->on('pacientes')
                ->onDelete('cascade');

            $table->foreign('id_alergia')
                ->references('id_alergia')
                ->on('alergias')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paciente_alergia');
    }
};
