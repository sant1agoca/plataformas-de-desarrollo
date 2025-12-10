@extends('layouts.app')

@section('title', 'Regristrar nuevo usuario')

@section('content')
<h3>Regristrar nuevo usuario</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf  
            <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Correo:</label>
                <input type="email" name="correo" class="form-control" value="{{old('correo') }}"> 
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
@endsection