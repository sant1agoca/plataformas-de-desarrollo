@extends('layouts.panel')

@section('title', 'Listado de Proyectos')

@section('content')

    <h3>Proyectos</h3>

    <a href="{{ route('proyectos.create') }}" class="btn btn-primary mb-3">Nuevo Proyecto</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto->id }}</td>
                    <td>{{ $proyecto->titulo }}</td>
                    <td>{{ $proyecto->usuario->nombre }}</td>
                    <td>
                        <a href="{{ route('proyectos.show', $proyecto->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection