<?php
// routes/api.php

use Illuminate\Support\Facades\Route;

// --- RUTA DE PRUEBA ---
Route::get('/test', function () {
    return response()->json(['status' => 'API is UP'], 200);
});
// -----------------------

use App\Http\Controllers\API\ProyectoController; 
use App\Http\Controllers\API\TareaController; 

Route::middleware(['api'])->group(function () {
    
    // Rutas RESTful para CRUD de Proyectos (incluye /proyectos y /proyectos/{id})
    Route::apiResource('proyectos', ProyectoController::class);
    
    // Rutas RESTful para CRUD de Tareas (incluye /tareas y /tareas/{id})
    Route::apiResource('tareas', TareaController::class);
    
    // CORRECCIÓN: Ruta anidada para Listar Tareas por Proyecto
    // La ruta ahora llama al método 'tareasPorProyecto' que sí existe en TareaController.
    Route::get('proyectos/{id}/tareas', [TareaController::class, 'tareasPorProyecto']);
});