<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id('id_paciente');
            $table->unsignedBigInteger('id_usuario');
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('sexo', ['M', 'F', 'O'])->nullable();
            $table->decimal('peso_kg', 5, 2)->nullable();
            $table->string('presion_arterial', 10)->nullable();
            $table->enum('etapa_erc', ['1', '2', '3a', '3b', '4', '5'])->nullable();
            $table->decimal('egfr', 5, 2)->nullable();
            $table->text('dieta_prescrita')->nullable();
            $table->boolean('perfil_completo')->default(false);
            $table->timestamps();

            $table->foreign('id_usuario')
                ->references('id_usuario')
                ->on('usuarios')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
