<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TareaController;

Route::apiResource('tareas', TareaController::class);