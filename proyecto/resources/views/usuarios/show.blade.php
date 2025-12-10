@extends('layouts.app')

@section('title', 'Listado de Usuarios')

@section('content')
<h3>Detalle del usuario</h3>
<ul>
    <li><strong>ID:</strong>{{  $usuario->id }}</li>
    <li><strong>Nombre:</strong>{{  $usuario->id }}</li>
    <li><strong>Correo:</strong>{{  $usuario->id }}</li>
</ul>
<a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
@endsection