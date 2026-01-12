<?php

namespace App\Http\Controllers; // <<-- ¡Namespace Web!

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Usuario; // Asumo que usas este modelo para el FK
use Illuminate\Validation\Rule;

class ProyectoController extends Controller
{
    

    /**
     * Listar Proyectos (Devuelve Vista)
     */
    public function index()
    {
        $proyectos = Proyecto::with('usuario')->get();
        return view('proyectos.index', compact('proyectos')); // VISTA
    }

    /**
     * Mostrar formulario de creación (Devuelve Vista)
     */
    public function create()
    {
        $usuarios = Usuario::all();
        return view('proyectos.create', compact('usuarios')); // VISTA
    }

    /**
     * Guardar nuevo proyecto desde la web (Redirección)
     */
    public function store(Request $request)
    {
        // Validaciones para la parte Webaa
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'], // Corregido: usa 'nombre' no 'titulo'
            'descripcion' => ['nullable', 'string'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['nullable', 'date'],
            'usuario_id' => ['required', 'exists:usuarios,id'], 
        ]);

        Proyecto::create($request->all());

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto creado exitosamente.');
    }

    /**
     * Mostrar detalle del proyecto (Devuelve Vista)
     */
    public function show(Proyecto $proyecto)
    {
        $proyecto->load('usuario');
        return view('proyectos.show', compact('proyecto')); // VISTA
    }

    /**
     * Mostrar formulario de edición (Devuelve Vista)
     */
    public function edit(Proyecto $proyecto)
    {
        $usuarios = Usuario::all();
        return view('proyectos.edit', compact('proyecto', 'usuarios')); // VISTA
    }

    /**
     * Actualizar proyecto (Redirección)
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'], // Corregido
            'descripcion' => ['nullable', 'string'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['nullable', 'date'],
            'usuario_id' => ['required', 'exists:usuarios,id'],
        ]);

        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto actualizado exitosamente.');
    }

    /**
     * Eliminar proyecto (Redirección)
     */
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete(); 
        
        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto eliminado exitosamente.');
    }
}