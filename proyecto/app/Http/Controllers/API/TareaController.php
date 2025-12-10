<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarea;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Tarea::all(),200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Las comas son reemplazadas por el pipe (|)
    $validated = $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'completada' => 'boolean'
    ]);
    
    $tarea = Tarea::create($validated);
    return response()->json($tarea,201);
    // ... Código para mostrar o actualizar ...
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request) // Se agrega Request
{
    $tarea = Tarea::find($id);

    if(!$tarea){
        return response()->json(['error' => 'Tarea no encontrada'],404);
    }
    return response()->json($tarea, 200);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tarea = Tarea::find($id);

        if(!$tarea){
        return response()->json(['error' => 'Tarea no encontrada'],404);
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'completada' => 'boolean'
        ]);

        $tarea->update($validated);

        return response()->json($tarea, 200);


    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tarea = Tarea::find($id);

        if(!$tarea){
        return response()->json(['error' => 'Tarea no encontrada'],404);
        }

        $tarea->delete();

        return response()->json(['message' => 'Tarea eliminada'],200);


    }
}
