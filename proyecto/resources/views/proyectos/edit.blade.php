@extends('layouts.panel')

@section('title', 'Editar Proyecto')

@section('content')

    <h3>Editar Proyecto</h3>

    <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ $proyecto->titulo }}">
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $proyecto->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label>Usuario responsable</label>
            <select name="usuario_id" class="form-control">
                @foreach ($usuarios as $u)
                    <option value="{{ $u->id }}" @if($u->id == $proyecto->usuario_id) selected @endif>
                        {{ $u->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
@endsection