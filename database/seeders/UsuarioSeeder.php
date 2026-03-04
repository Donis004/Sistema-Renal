<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador
        Usuario::create([
            'nombre' => 'Admin Sistema',
            'email' => 'admin@sistemarenal.com',
            'password_hash' => Hash::make('password123'),
            'rol' => 'ADMIN',
        ]);

        // Crear doctores
        Usuario::create([
            'nombre' => 'Dr. Juan Pérez',
            'email' => 'juan.perez@sistemarenal.com',
            'password_hash' => Hash::make('password123'),
            'rol' => 'DOCTOR',
        ]);

        Usuario::create([
            'nombre' => 'Dr. Carlos López',
            'email' => 'carlos.lopez@sistemarenal.com',
            'password_hash' => Hash::make('password123'),
            'rol' => 'DOCTOR',
        ]);

        // Crear nutricionistas
        Usuario::create([
            'nombre' => 'Dra. María García',
            'email' => 'maria.garcia@sistemarenal.com',
            'password_hash' => Hash::make('password123'),
            'rol' => 'NUTRICIONISTA',
        ]);

        Usuario::create([
            'nombre' => 'Lic. Laura Martínez',
            'email' => 'laura.martinez@sistemarenal.com',
            'password_hash' => Hash::make('password123'),
            'rol' => 'NUTRICIONISTA',
        ]);

        // Crear usuarios pacientes
        Usuario::create([
            'nombre' => 'Juan Rodríguez',
            'email' => 'juan.rodriguez@example.com',
            'password_hash' => Hash::make('password123'),
            'rol' => 'PACIENTE',
        ]);

        Usuario::create([
            'nombre' => 'María López',
            'email' => 'maria.lopez@example.com',
            'password_hash' => Hash::make('password123'),
            'rol' => 'PACIENTE',
        ]);
    }
}
