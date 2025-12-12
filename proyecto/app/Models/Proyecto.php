<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// Asegúrate de que importas el modelo Usuario si lo usas
use App\Models\Usuario; 
// Si usas el modelo User por defecto, usa: use App\Models\User;

class Proyecto extends Model
{ 
    use HasFactory;

    protected $table = 'proyectos';

    // CORRECCIÓN CRÍTICA: Ahora incluye todos los campos del JSON y la FK
    protected $fillable = [
        'nombre',       
        'descripcion',
        'fecha_inicio', 
        'fecha_fin',    
        'usuario_id',   // Si lo envías, debe estar aquí.
    ];

    /**
     * Relación 1:N: Un proyecto tiene muchas tareas
     */
    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class);
    }
    
    /**
     * Relación N:1: Un proyecto pertenece a un usuario/responsable
     */
    public function usuario(): BelongsTo 
    {
        // Asumo que tu modelo de usuario se llama 'Usuario'
        return $this->belongsTo(Usuario::class, 'usuario_id');
        // Si usas el modelo por defecto, cámbialo a User::class
    }
}