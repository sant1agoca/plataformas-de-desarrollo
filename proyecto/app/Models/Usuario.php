<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    // Indicar explícitamente el nombre de la tabla (opcional si es 'usuarios')
    protected $table = 'usuarios';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'correo',
        'password', 
    ];
}