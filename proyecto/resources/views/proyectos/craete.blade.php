@extends('layouts.panel')

@section('title', 'Crear Proyecto')

@section('content')

    <h3>Crear Proyecto</h3>

    <form action="{{ route('proyectos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="titulo" class="form-control">
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Usuario responsable</label>
            <select name="usuario_id" class="form-control">
                @foreach ($usuarios as $u)
                    <option value="{{ $u->id }}">{{ $u->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
@endsection