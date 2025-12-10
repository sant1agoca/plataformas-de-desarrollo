@extends('layouts.app')

@section('title', 'Listado de Usuarios')

@section('content')
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>Usuarios Registrados</h3> 
        
        
        <a href="{{ route('usuarios.create') }}" class="btn btn-success">Crear Nuevo Usuario</a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div> 
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
    
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->correo }}</td>
                <td>
                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-info btn-sm">Ver</a> 
                    
                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display: inline-block;"> 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar a {{ $usuario->nombre }}?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection


