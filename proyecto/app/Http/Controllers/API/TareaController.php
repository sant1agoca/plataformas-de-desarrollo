<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TareaController extends Controller
{
    // Opcional: Si necesitas deshabilitar el middleware, añádelo aquí
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum')->except(['index', 'store', 'show', 'update', 'destroy', 'tareasPorProyecto']); 
    // }

    /**
     * Display a listing of the resource (GET /api/tareas).
     */
    public function index()
    {
        try {
            // Carga todas las tareas
            $tareas = Tarea::all();
            return response()->json($tareas, 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al listar las tareas.',
                'error_detail' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage (POST /api/tareas).
     */
    public function store(Request $request)
    {
        try {
            // Reglas de validación (Asegúrate de que 'proyecto_id' exista)
            $request->validate([
                'titulo' => 'required|string|max:255',
                'descripcion' => 'nullable|string',
                'completada' => 'required|boolean',
                'proyecto_id' => 'required|exists:proyectos,id'
            ]);

            $tarea = Tarea::create($request->all());

            return response()->json($tarea, 201); // 201 Created

        } catch (ValidationException $e) {
            return response()->json(['message' => 'Datos no válidos.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear la tarea.',
                'error_detail' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource (GET /api/tareas/{id}).
     */
    public function show($id)
    {
        try {
            $tarea = Tarea::findOrFail($id);
            return response()->json($tarea, 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Tarea no encontrada.'], 404);
        } catch (\Exception $e) {
             return response()->json([
                 'message' => 'Error al obtener la tarea.',
                 'error_detail' => $e->getMessage()
             ], 500);
        }
    }

    /**
     * Update the specified resource in storage (PUT/PATCH /api/tareas/{id}).
     */
    public function update(Request $request, $id)
    {
        try {
            $tarea = Tarea::findOrFail($id);

            // Reglas de validación con 'sometimes' para no requerir todos los campos
            $request->validate([
                'titulo' => 'sometimes|required|string|max:255',
                'descripcion' => 'sometimes|nullable|string',
                'completada' => 'sometimes|required|boolean',
                'proyecto_id' => 'sometimes|required|exists:proyectos,id'
            ]);
            
            $tarea->update($request->all());

            return response()->json($tarea, 200);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Tarea no encontrada.'], 404);
        } catch (ValidationException $e) {
            return response()->json(['message' => 'Datos no válidos.', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
             return response()->json([
                 'message' => 'Error al actualizar la tarea.',
                 'error_detail' => $e->getMessage()
             ], 500);
        }
    }

    /**
     * Remove the specified resource from storage (DELETE /api/tareas/{id}).
     */
    public function destroy($id)
    {
        try {
            $tarea = Tarea::findOrFail($id);
            $tarea->delete();

            // Respuesta 204 No Content (Éxito sin cuerpo de respuesta)
            return response()->json(null, 204);

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Tarea no encontrada.'], 404);
        } catch (\Exception $e) {
             return response()->json([
                 'message' => 'Error al eliminar la tarea.',
                 'error_detail' => $e->getMessage()
             ], 500);
        }
    }

    /**
     * GET /api/proyectos/{id}/tareas (Listar tareas por Proyecto)
     * Método añadido para solucionar el error de BadMethodCallException.
     */
    public function tareasPorProyecto($proyectoId)
    {
        try {
            // Buscamos las tareas donde el 'proyecto_id' coincida con el ID de la URL
            $tareas = Tarea::where('proyecto_id', $proyectoId)->get();
            
            if ($tareas->isEmpty() && !\App\Models\Proyecto::find($proyectoId)) {
                // Si está vacío y el proyecto no existe, retornamos 404
                return response()->json(['message' => 'Proyecto no encontrado o ID inválido.'], 404);
            }

            return response()->json($tareas, 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener las tareas por proyecto.', 
                'error_detail' => $e->getMessage()
            ], 500);
        }
    }
}