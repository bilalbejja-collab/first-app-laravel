@extends('layouts.app')

@section('title', 'Empleados')
@section('active2', 'active')
@section('contador', $contador)

@section('content')
    <div><a href="/empleados/create"><button class="btn btn-primary">Nuevo empleado</button></a></div>

    <table class="table">
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Dni</th>
            <th>Dirección</th>
            <th>Ciudad</th>
            <th>Cargo</th>
            <th>Erte</th>
            <th>Acciones</th>
        </tr>

        @foreach($empleados as $empleado)
            <tr>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->apellidos }}</td>
                <td>{{ $empleado->dni }}</td>
                <td>{{ $empleado->direccion }}</td>
                <td>{{ $empleado->ciudad }}</td>
                <td>{{ $empleado->cargo }}</td>
                <td>
                    @if ($empleado->erte)
                        SI
                    @else
                        NO
                    @endif
                </td>
                <td>
                    <a href="/empleados/{{ $empleado }}/delete"><button class="btn btn-primary"><i class="fas fa-trash-alt"></i></button></a>
                    <a href="/empleados/{{ $empleado->id }}/edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
                    <a href="/empleados/{{ $empleado->id }}"><button class="btn btn-primary"><i class="fas fa-binoculars"></i></button></a>
                </td>
            </tr>
        @endforeach
    </table>
    <div>
        {{ $empleados->links() }} Total: {{ $empleados->count() }}
    </div>
@endsection
