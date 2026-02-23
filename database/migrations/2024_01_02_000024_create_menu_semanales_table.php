<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_semanales', function (Blueprint $table) {
            $table->id('id_menu');
            $table->unsignedBigInteger('id_paciente');
            $table->date('semana_inicio')->nullable();
            $table->timestamps();

            $table->foreign('id_paciente')
                ->references('id_paciente')
                ->on('pacientes')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_semanales');
    }
};
