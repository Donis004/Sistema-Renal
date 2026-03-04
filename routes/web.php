<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ComidaController;
use App\Http\Controllers\AlimentoController;

//mario controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Paciente\PerfilPacienteController;
use App\Http\Controllers\Paciente\PacienteDashboardController;
use App\Http\Controllers\Paciente\ComidaPacienteController;
use App\Http\Controllers\Paciente\AlimentoPacienteController;
use App\Http\Controllers\Paciente\MedicamentoPacienteController;
use App\Http\Controllers\Paciente\SintomaPacienteController;
use App\Http\Controllers\Paciente\AlertaPacienteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Landing Page
Route::get('/', function () {
    return view('welcome'); // La vista principal
})->name('inicio');

// Rutas del Administrador
Route::prefix('administrador')->name('administrador.')->group(function () {
    // Home y Dashboard del administrador
    Route::get('/home', [AdministradorController::class, 'home'])->name('home');
    Route::get('/dashboard', [AdministradorController::class, 'home'])->name('dashboard');
    
    // Rutas de Usuarios (CRUD completo)
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{id_usuario}', [UsuarioController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/{id_usuario}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id_usuario}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id_usuario}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    Route::patch('/usuarios/{id_usuario}/toggle-estado', [UsuarioController::class, 'toggleEstado'])->name('usuarios.toggleEstado');
    
    // Rutas de Comidas (CRUD completo)
    Route::get('/comidas', [ComidaController::class, 'index'])->name('comidas.index');
    Route::get('/comidas/create', [ComidaController::class, 'create'])->name('comidas.create');
    Route::post('/comidas', [ComidaController::class, 'store'])->name('comidas.store');
    Route::get('/comidas/{id_comida}', [ComidaController::class, 'show'])->name('comidas.show');
    Route::get('/comidas/{id_comida}/edit', [ComidaController::class, 'edit'])->name('comidas.edit');
    Route::put('/comidas/{id_comida}', [ComidaController::class, 'update'])->name('comidas.update');
    Route::delete('/comidas/{id_comida}', [ComidaController::class, 'destroy'])->name('comidas.destroy');
    
    // Rutas de Detalles de Comida (agregar/eliminar alimentos)
    Route::post('/comidas/{id_comida}/agregar-alimento', [ComidaController::class, 'agregarAlimento'])->name('comidas.agregarAlimento');
    Route::delete('/comidas/eliminar-alimento/{id_detalle}', [ComidaController::class, 'eliminarAlimento'])->name('comidas.eliminarAlimento');
    
    // Rutas de Pacientes
    Route::get('/pacientes', [AdministradorController::class, 'pacientesIndex'])->name('pacientes.index');
    
    // Rutas de Alimentos
    Route::get('/alimentos', [AlimentoController::class, 'index'])->name('alimentos.index');
    Route::get('/alimentos/create', [AlimentoController::class, 'create'])->name('alimentos.create');
    Route::post('/alimentos', [AlimentoController::class, 'store'])->name('alimentos.store');
    Route::get('/alimentos/{alimento}', [AlimentoController::class, 'show'])->name('alimentos.show');
    Route::get('/alimentos/{alimento}/edit', [AlimentoController::class, 'edit'])->name('alimentos.edit');
    Route::put('/alimentos/{alimento}', [AlimentoController::class, 'update'])->name('alimentos.update');
    Route::delete('/alimentos/{alimento}', [AlimentoController::class, 'destroy'])->name('alimentos.destroy');
    
    // Rutas de Medicamentos
    Route::get('/medicamentos', [AdministradorController::class, 'medicamentosIndex'])->name('medicamentos.index');
    
    // Rutas de Contenidos Educativos
    Route::get('/contenidos', [AdministradorController::class, 'contenidosIndex'])->name('contenidos.index');
    
    // Rutas de Reportes
    Route::get('/reportes', [AdministradorController::class, 'reportesIndex'])->name('reportes.index');
});

// Rutas de Usuarios (legacy - redirecciona a administrador)
Route::get('/usuarios', function () {
    return redirect()->route('administrador.usuarios.index');
});

// Rutas de Autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// GRUPO DE RUTAS: PACIENTES (Protegidas)
// ==========================================
Route::prefix('paciente')->middleware('auth')->group(function () {
    
    // Rutas de Perfil
    Route::get('/perfil/completar', [PerfilPacienteController::class, 'completar'])->name('paciente.perfil.completar');
    Route::post('/perfil/guardar', [PerfilPacienteController::class, 'guardarPerfil'])->name('paciente.perfil.guardar');
    
    Route::get('/perfil', [PerfilPacienteController::class, 'show'])->name('paciente.perfil.show');
    // Route::get('/perfil/editar', [PerfilPacienteController::class, 'edit'])->name('paciente.perfil.edit');

    // Dashboard Principal
    Route::get('/dashboard', [PacienteDashboardController::class, 'index'])->name('paciente.dashboard');
    
    // Control de Líquidos Rápido
    Route::post('/liquidos', [PacienteDashboardController::class, 'storeLiquido'])->name('paciente.liquidos.store');

    // Módulo de Comidas
    Route::prefix('comidas')->name('paciente.comidas.')->group(function () {
        Route::get('/', [ComidaPacienteController::class, 'index'])->name('index');
        
        // Flujo Manual
        Route::get('/manual', [ComidaPacienteController::class, 'createManual'])->name('create_manual');
        Route::post('/manual', [ComidaPacienteController::class, 'storeManual'])->name('store_manual');
        
        // Flujo Foto/IA (Vistas preparadas)
        Route::get('/foto', [ComidaPacienteController::class, 'createFoto'])->name('create_foto');
        Route::post('/foto', [ComidaPacienteController::class, 'procesarFoto'])->name('procesar_foto');
        Route::post('/confirmar-ia', [ComidaPacienteController::class, 'confirmarIa'])->name('confirmar_ia');
    });

    // Módulo de Alimentos y Sugerencias
    Route::get('/alimentos/sugerencias', [AlimentoPacienteController::class, 'sugerencias'])->name('paciente.alimentos.sugerencias');

    // Módulo de Medicamentos
    Route::prefix('medicamentos')->name('paciente.medicamentos.')->group(function () {
        Route::get('/', [MedicamentoPacienteController::class, 'index'])->name('index');
        Route::get('/crear', [MedicamentoPacienteController::class, 'create'])->name('create');
        Route::post('/', [MedicamentoPacienteController::class, 'store'])->name('store');
        Route::get('/{id}/editar', [MedicamentoPacienteController::class, 'edit'])->name('edit');
        Route::put('/{id}', [MedicamentoPacienteController::class, 'update'])->name('update');
        Route::delete('/{id}', [MedicamentoPacienteController::class, 'destroy'])->name('destroy');
        
        // Ruta para marcar el checkbox de "Tomado"
        Route::patch('/recordatorios/{id}/tomado', [MedicamentoPacienteController::class, 'marcarTomado'])->name('marcar_tomado');
    });

    // Rutas de Perfil
    Route::get('/perfil/completar', [PerfilPacienteController::class, 'completar'])->name('paciente.perfil.completar');
    Route::post('/perfil/guardar', [PerfilPacienteController::class, 'guardarPerfil'])->name('paciente.perfil.guardar');
    
    Route::get('/perfil', [PerfilPacienteController::class, 'show'])->name('paciente.perfil.show');
    Route::get('/perfil/editar', [PerfilPacienteController::class, 'edit'])->name('paciente.perfil.edit');
    Route::put('/perfil/editar', [PerfilPacienteController::class, 'update'])->name('paciente.perfil.update');

    // Módulo de Síntomas
    Route::prefix('sintomas')->name('paciente.sintomas.')->group(function () {
        Route::get('/', [SintomaPacienteController::class, 'index'])->name('index');
        Route::get('/registrar', [SintomaPacienteController::class, 'create'])->name('create');
        Route::post('/', [SintomaPacienteController::class, 'store'])->name('store');
    });


    // Módulo de Alertas
    Route::prefix('alertas')->name('paciente.alertas.')->group(function () {
        Route::get('/', [AlertaPacienteController::class, 'index'])->name('index');
        Route::post('/recalcular', [AlertaPacienteController::class, 'recalcular'])->name('recalcular');
        Route::patch('/{id}/atendida', [AlertaPacienteController::class, 'marcarAtendida'])->name('atendida');
    });
    
});