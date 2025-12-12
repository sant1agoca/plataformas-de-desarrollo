<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// CORRECCIONES CRÍTICAS: Asegurar que todos los controladores Web estén importados
use App\Http\Controllers\UsuarioController; 
use App\Http\Controllers\ProyectoController; 
use App\Http\Controllers\AdminController; 


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Rutas de Autenticación (Login, Register, Logout) ---
require __DIR__.'/auth.php';

// --- Ruta de inicio ---
Route::get('/', function () {
    // Redirige al dashboard por defecto después de loguearse
    return redirect()->route('dashboard'); 
});

// -----------------------------------------------------------------
// GRUPO DE RUTAS PROTEGIDAS (Requieren que el usuario haya iniciado sesión)
// -----------------------------------------------------------------
Route::middleware('auth')->group(function () {
    
    // Ruta del Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Rutas CRUD de Usuarios
    Route::resource('usuarios', UsuarioController::class);

    // Rutas CRUD de Proyectos (Para las vistas Blade)
    Route::resource('proyectos', ProyectoController::class);

    // Rutas de Administración (Ya corregida la importación de AdminController)
    Route::get('/admin', [AdminController::class, 'index'])->middleware('role:admin')->name('admin.index');

    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});