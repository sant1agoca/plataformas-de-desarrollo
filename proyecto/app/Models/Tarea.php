<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';
    // Corrección: La coma debe ir *después* de la cadena de texto, no dentro.
    protected $fillable = ['titulo', 'descripcion', 'completada'];
}
