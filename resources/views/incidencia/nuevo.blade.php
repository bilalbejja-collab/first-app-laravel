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

<form method="POST" action="/incidencias" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="latitud">Latitud</label>
        <input class="form-control" name="latitud" id="latitud" type="text" value="{{ old('latitud') }}">
    </div>

    <div class="form-group">
        <label for="longitud">Longitud</label>
        <input class="form-control" name="longitud" id="longitud" type="text" value="{{ old('longitud') }}">
    </div>

    <div class="form-group">
        <label for="ciudad">Ciudad</label>
        <input class="form-control" name="ciudad" id="ciudad" type="text" value="{{ old('ciudad') }}">
    </div>

    <div class="form-group">
        <label for="direccion">Dirección</label>
        <input class="form-control" name="direccion" id="direccion" type="text" value="{{ old('direccion') }}">
    </div>

    <div class="form-group">
        <label for="etiqueta">Etiqueta</label>
        <input class="form-control" name="etiqueta" id="etiqueta" type="text" value="{{ old('etiqueta') }}">
    </div>

    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" name="descripcion" id="descripcion" ></textarea>
    </div>

    <div class="form-group">
        <label for="estado">Estado</label>
        <input class="form-control" name="estado" id="estado" type="text" value="{{ old('estado') }}">
    </div>

    <div class="form-group">
        <label for="nivel">Nivel</label>
        <input class="form-control" name="nivel" id="nivel" type="text" value="{{ old('nivel') }}">
    </div>

    <div class="form-group">
        <label for="foto">Foto</label>
        <input class="form-control" name="foto" id="foto" type="file">
    </div>

    <input type="submit" value="Crear">
</form>

@endsection
