<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController; 
use App\Http\Controllers\ProyectoController; 
use App\Http\Controllers\AdminController; // Importación del nuevo controlador

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí registras tus rutas web.
|
*/

// --- Rutas de Autenticación (Login, Register, Logout) ---
// Debe ir al inicio para que el flujo de autenticación esté disponible.
require __DIR__.'/auth.php';

// --- Ruta de inicio ---
// Redirige la raíz a la lista de usuarios.
Route::get('/', function () {
    // Si el usuario ya está autenticado, puede ir a 'usuarios.index',
    // sino, será redirigido al login por el middleware.
    return redirect()->route('usuarios.index');
});

// -----------------------------------------------------------------
// GRUPO DE RUTAS PROTEGIDAS (Requieren que el usuario haya iniciado sesión)
// -----------------------------------------------------------------
Route::middleware('auth')->group(function () {
    
    // Ruta del Dashboard (Requiere autenticación y verificación de email)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Rutas CRUD de Usuarios
    Route::resource('usuarios', UsuarioController::class);

    // Rutas CRUD de Proyectos
    Route::resource('proyectos', ProyectoController::class);

    // Rutas de Administración (Protegida por el middleware 'role:admin')
    Route::get('/admin', [AdminController::class, 'index'])->middleware('role:admin')->name('admin.index');

    // Rutas de perfil (generadas por defecto por Laravel)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});