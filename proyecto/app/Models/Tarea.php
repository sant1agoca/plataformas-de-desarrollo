<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'completada',
        'proyecto_id', // <-- ¡CRÍTICO! Debe estar aquí para el POST funcionar.
    ];

    /**
     * Obtiene el proyecto al que pertenece esta tarea.
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}