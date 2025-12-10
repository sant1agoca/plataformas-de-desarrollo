@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
    <h3>Editar Usuario</h3>
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT') 
        
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $usuario->nombre) }}">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Correo:</label>
            <input type="email" name="correo" class="form-control" value="{{ old('correo', $usuario->correo) }}"> 
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection