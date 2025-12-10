<?php

namespace App\Http\Controllers;

use App\Models\Usuario; // Importación necesaria para usar el modelo
use Illuminate\Http\Request;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Support\Facades\Hash; // Importamos la Facade Hash

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mostrar lista
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar el formulario de creación
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request)
    {
        // Guardar datos, incluyendo la contraseña hasheada
        Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            // Asumiendo que el campo 'password' existe en la tabla y en el StoreUsuarioRequest
            'password' => Hash::make($request->password), 
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // El método show generalmente busca y muestra un solo registro.
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // El método edit busca el registro y muestra el formulario de edición.
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, string $id)
    {
        // Actualizar datos
        $usuario = Usuario::findOrFail($id);
        
        $data = [
            'nombre' => $request->nombre,
            'correo' => $request->correo
        ];

        // Solo actualizamos la contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar registro
        Usuario::destroy($id);
        
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito.');
    }
}