<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Proyecto extends Model
{
protected $table= ‘proyectos’;
protected $fillable = [‘titulo’,’descripcion’,‘usuario_id’];
public function usuario()
{
// app/Models/Proyecto.php (Línea 10)
return $this->belongsTo(related: Usuario::class);
}
}
