@extends('layouts.panel')

@section('title', 'Detalle Proyecto')

@section('content')

    <h3>Proyecto: {{ $proyecto->titulo }}</h3>

    <p><strong>Descripción:</strong> {{ $proyecto->descripcion }}</p>
    <p><strong>Responsable:</strong> {{ $proyecto->usuario->nombre }}</p>

    <a href="{{ route('proyectos.index') }}" class="btn btn-secondary">Volver</a>
@endsection