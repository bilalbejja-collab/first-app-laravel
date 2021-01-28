@extends('layouts.app')

@section('title', $mensaje)
@section('active2', ' active')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form method="POST" action="/incidencias/{{ $incidencia->id }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="latitud">Latitud</label>
        <input class="form-control" name="latitud" id="latitud" type="text" value="{{ $incidencia->latitud }}">
    </div>

    <div class="form-group">
        <label for="longitud">Longitud</label>
        <input class="form-control" name="longitud" id="longitud" type="text" value="{{ $incidencia->longitud }}">
    </div>

    <div class="form-group">
        <label for="ciudad">Ciudad</label>
        <input class="form-control" name="ciudad" id="ciudad" type="text" value="{{ $incidencia->ciudad }}">
    </div>

    <div class="form-group">
        <label for="direccion">Dirección</label>
        <input class="form-control" name="direccion" id="direccion" type="text" value="{{ $incidencia->direccion }}">
    </div>

    <div class="form-group">
        <label for="etiqueta">Etiqueta</label>
        <input class="form-control" name="etiqueta" id="etiqueta" type="text" value="{{ $incidencia->etiqueta }}">
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" name="descripcion" id="descripcion" >{{ $incidencia->descripcion }}</textarea>
    </div>

    <div class="form-group">
        <label for="estado">Estado</label>
        <input class="form-control" name="estado" id="estado" type="text" value="{{ $incidencia->estado }}">
    </div>

    <div class="form-group">
        <label for="nivel">Nivel</label>
        <input class="form-control" name="nivel" id="nivel" type="text" value="{{ $incidencia->nivel }}">
    </div>

    <div class="form-group">
        <label for="foto">Foto</label>
        <input class="form-control" name="foto" id="foto" type="file">
    </div>

    <input type="submit" value="Modificar">
</form>

@endsection
