<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Usuario;
use Illuminate\Validation\Rule; // Necesario si queremos usar reglas de validación avanzadas

class ProyectoController extends Controller
{
    /**
     * Proteger módulo: Requiere que el usuario esté autenticado.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource (READ).
     */
    public function index()
    {
        // Carga todos los proyectos incluyendo el usuario relacionado (Eager Loading)
        $proyectos = Proyecto::with('usuario')->get();
        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pasa todos los usuarios al formulario para la selección
        $usuarios = Usuario::all();
        return view('proyectos.create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage (CREATE).
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            // Asegura que el usuario_id exista en la tabla 'usuarios'
            'usuario_id' => ['required', 'exists:usuarios,id'], 
        ]);

        Proyecto::create($request->all());

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     * Implementa Model Binding: Recibe la instancia de Proyecto en lugar del ID.
     */
    public function show(Proyecto $proyecto)
    {
        // El proyecto ya está cargado por Laravel. Cargamos la relación si es necesario.
        $proyecto->load('usuario');
        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     * Implementa Model Binding.
     */
    public function edit(Proyecto $proyecto)
    {
        // El proyecto ya está cargado.
        $usuarios = Usuario::all();
        return view('proyectos.edit', compact('proyecto', 'usuarios'));
    }

    /**
     * Update the specified resource in storage (UPDATE).
     * Implementa Model Binding.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'usuario_id' => ['required', 'exists:usuarios,id'],
        ]);

        // Ya no necesitamos findOrFail($id)
        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage (DELETE).
     * Implementa Model Binding.
     */
    public function destroy(Proyecto $proyecto)
    {
        // Ya no necesitamos findOrFail($id) ni Proyecto::destroy()
        $proyecto->delete(); 
        
        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto eliminado exitosamente.');
    }
}