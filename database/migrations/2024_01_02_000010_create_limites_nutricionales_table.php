<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('limites_nutricionales', function (Blueprint $table) {
            $table->id('id_limite');
            $table->unsignedBigInteger('id_paciente');
            $table->integer('potasio_mg')->nullable();
            $table->integer('fosforo_mg')->nullable();
            $table->integer('sodio_mg')->nullable();
            $table->integer('liquidos_ml')->nullable();
            $table->decimal('proteina_g', 5, 2)->nullable();
            $table->enum('origen', ['AUTOMATICO', 'MANUAL'])->nullable();
            $table->unsignedBigInteger('ajustado_por')->nullable();
            $table->text('justificacion')->nullable();
            $table->timestamp('fecha_actualizacion')->useCurrent();
            $table->timestamps();

            $table->foreign('id_paciente')
                ->references('id_paciente')
                ->on('pacientes')
                ->onDelete('cascade');

            $table->foreign('ajustado_por')
                ->references('id_usuario')
                ->on('usuarios')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('limites_nutricionales');
    }
};
