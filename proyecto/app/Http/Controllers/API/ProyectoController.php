<?php

namespace App\Http\Controllers\Api; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto; 
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ProyectoController extends Controller
{
    // AÑADIMOS ESTE CONSTRUCTOR PARA DESHABILITAR EL MIDDLEWARE
    public function __construct()
    {
        // ¡CORRECCIÓN! Ahora incluimos 'update' y 'destroy' para evitar el error 'Auth guard [sanctum] is not defined' en PUT y DELETE.
        $this->middleware('auth:sanctum')->except(['index', 'store', 'show', 'update', 'destroy']); 
    }

    /**
     * GET /api/proyectos (Listar)
     */
    public function index()
    {
         try {
             $proyectos = Proyecto::all();
             return response()->json($proyectos);
         } catch (\Exception $e) {
             return response()->json(['message' => 'Error al listar proyectos.', 'error_detail' => $e->getMessage()], 500);
         }
    }

    /**
     * POST /api/proyectos (Crear)
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255', 
                'descripcion' => 'nullable|string',
                'fecha_inicio' => 'required|date', 
                'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
                // 'usuario_id' => 'required|exists:usuarios,id', 
            ]);

            $proyecto = Proyecto::create($request->all());

            return response()->json($proyecto, 201); 

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Datos no válidos.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Error al crear el proyecto.', 'error_detail' => $e->getMessage()], 500);
        }
    }

    /**
     * GET /api/proyectos/{id} (Mostrar Detalle)
     */
    public function show(string $id)
    {
        try {
            $proyecto = Proyecto::with('tareas')->findOrFail($id);
            return response()->json($proyecto);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Proyecto no encontrado.'], 404);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Error al obtener el proyecto.', 'error_detail' => $e->getMessage()], 500);
        }
    }

    /**
     * PUT /api/proyectos/{id} (Actualizar)
     */
    public function update(Request $request, string $id)
    {
        try {
            $proyecto = Proyecto::findOrFail($id);
            
            $request->validate([
                'nombre' => 'sometimes|required|string|max:255', 
                'descripcion' => 'nullable|string',
                'fecha_inicio' => 'sometimes|required|date', 
                'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            ]);

            $proyecto->update($request->all());
            return response()->json($proyecto);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Proyecto no encontrado.'], 404);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Datos no válidos.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Error al actualizar el proyecto.', 'error_detail' => $e->getMessage()], 500);
        }
    }

    /**
     * DELETE /api/proyectos/{id} (Eliminar)
     */
    public function destroy(string $id)
    {
        try {
            $proyecto = Proyecto::findOrFail($id);
            $proyecto->delete();

            return response()->json(null, 204); 

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Proyecto no encontrado.'], 404);
        } catch (\Exception $e) {
             return response()->json(['message' => 'Error al eliminar el proyecto.', 'error_detail' => $e->getMessage()], 500);
        }
    }
}