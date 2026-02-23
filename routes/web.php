<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ComidaController;
use App\Http\Controllers\AlimentoController;

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

Route::get('/', function () {
    return redirect()->route('administrador.home');
});

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
