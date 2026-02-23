<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consumo_liquidos', function (Blueprint $table) {
            $table->id('id_consumo');
            $table->unsignedBigInteger('id_paciente');
            $table->integer('cantidad_ml')->nullable();
            $table->string('descripcion', 100)->nullable();
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
        Schema::dropIfExists('consumo_liquidos');
    }
};
