<?php

namespace App\Http\Controllers\Api; // <<-- ¡Namespace de la API!

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto; 

class ProyectoController extends Controller
{
    /**
     * GET /api/proyectos (Listar)
     */
    public function index()
    {
        $proyectos = Proyecto::all();
        // Devuelve JSON
        return response()->json($proyectos);
    }

    /**
     * POST /api/proyectos (Crear) - ¡Tu primera prueba obligatoria!
     */
    public function store(Request $request)
    {
        // Validación obligatoria (Criterio Validaciones y errores - 10%)
        $request->validate([
            'nombre' => 'required|string|max:255', // Requisito
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date', // Requisito
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio', // Requisito
            // Asumo que 'usuario_id' es opcional en la API o se establece después.
        ]);

        $proyecto = Proyecto::create($request->all());

        // Devuelve JSON con código 201 Created
        return response()->json($proyecto, 201); 
    }

    /**
     * GET /api/proyectos/{id} (Mostrar Detalle)
     */
    public function show(string $id)
    {
        // Cargar proyecto y sus tareas (Requisito ver tareas)
        $proyecto = Proyecto::with('tareas')->findOrFail($id);
        return response()->json($proyecto);
    }

    /**
     * PUT /api/proyectos/{id} (Actualizar)
     */
    public function update(Request $request, string $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $proyecto->update($request->all());

        return response()->json($proyecto);
    }

    /**
     * DELETE /api/proyectos/{id} (Eliminar)
     */
    public function destroy(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        // 204 No Content para eliminación exitosa
        return response()->json(null, 204); 
    }
}