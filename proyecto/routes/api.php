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
    Route::apiResource('proyectos', ProyectoController::class);
    Route::apiResource('tareas', TareaController::class);
    Route::get('proyectos/{id}/tareas', [TareaController::class, 'listarPorProyecto']);
});