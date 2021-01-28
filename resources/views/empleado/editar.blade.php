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


<form method="POST" action="/empleados/{{ $empleado->id }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input class="form-control" name="nombre" id="nombre" type="text" value="{{ $empleado->nombre }}">
    </div>

    <div class="form-group">
        <label for="apellidos">Apellidos</label>
        <input class="form-control" name="apellidos" id="apellidos" type="text" value="{{ $empleado->apellidos }}">
    </div>

    <div class="form-group">
        <label for="dni">DNI</label>
        <input class="form-control" name="dni" id="dni" type="text" value="{{ $empleado->dni }}">
    </div>

    <div class="form-group">
        <label for="direccion">Direccion</label>
        <input class="form-control" name="direccion" id="direccion" type="text" value="{{ $empleado->direccion }}">
    </div>

    <div class="form-group">
        <label for="ciudad">Ciudad</label>
        <input class="form-control" name="ciudad" id="ciudad" type="text" value="{{ $empleado->ciudad }}">
    </div>

    <div class="form-group">
        <label for="cargo">Cargo</label>
        <input class="form-control" name="cargo" id="cargo" type="text" value="{{ $empleado->cargo }}">
    </div>

    @if($empleado->erte == 1)
        <div class="form-check">
            <input class="form-check-input" name="erte" id="erte" type="radio" value="1" checked>
            <label class="form-check-label" for="exampleRadio1">Está en Erte</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" name="erte" id="noerte" type="radio" value="0">
            <label class="form-check-label" for="exampleRadio1">No está en Erte</label>
        </div>
    @else
        <div class="form-check">
            <input class="form-check-input" name="erte" id="erte" type="radio" value="0">
            <label class="form-check-label" for="exampleRadio1">Está en Erte</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" name="erte" id="noerte" type="radio" value="1" checked>
            <label class="form-check-label" for="exampleRadio1">No está en Erte</label>
        </div>
    @endif

    <div class="form-group">
        <label for="foto">Foto</label>
        <input class="form-control" name="foto" id="foto" type="file">
    </div>

    <input type="submit" value="Modificar">
</form>

@endsection
