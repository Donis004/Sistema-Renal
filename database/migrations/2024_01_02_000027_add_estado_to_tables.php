<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Agregar estado a pacientes
        Schema::table('pacientes', function (Blueprint $table) {
            $table->boolean('estado')->default(true)->after('perfil_completo');
        });

        // Agregar estado a alimentos
        Schema::table('alimentos', function (Blueprint $table) {
            $table->boolean('estado')->default(true)->after('seguro_renal');
        });

        // Agregar estado a comidas
        Schema::table('comidas', function (Blueprint $table) {
            $table->boolean('estado')->default(true)->after('fecha_hora');
        });

        // Agregar estado a medicamentos
        Schema::table('medicamentos', function (Blueprint $table) {
            $table->boolean('estado')->default(true)->after('nombre');
        });

        // Agregar estado a menu_semanales
        Schema::table('menu_semanales', function (Blueprint $table) {
            $table->boolean('estado')->default(true)->after('semana_inicio');
        });

        // Agregar estado a contenidos_educativos
        Schema::table('contenidos_educativos', function (Blueprint $table) {
            $table->boolean('estado')->default(true)->after('contenido');
        });

        // Agregar estado a limites_nutricionales
        Schema::table('limites_nutricionales', function (Blueprint $table) {
            $table->boolean('estado')->default(true)->after('fecha_actualizacion');
        });

        // Agregar estado a alertas_clinicas
        Schema::table('alerta_clinicas', function (Blueprint $table) {
            $table->boolean('estado')->default(true)->after('atendida');
        });

        // Agregar estado a recomendaciones
        Schema::table('recomendaciones', function (Blueprint $table) {
            $table->boolean('estado')->default(true)->after('fecha');
        });
    }

    public function down(): void
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('alimentos', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('comidas', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('medicamentos', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('menu_semanales', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('contenidos_educativos', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('limites_nutricionales', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('alerta_clinicas', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('recomendaciones', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
