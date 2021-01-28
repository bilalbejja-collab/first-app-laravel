@extends('layouts.app')

@section('content')
<x-profile title="Empleado">
    <p>{{ $empleado->nombre }}</p>
    <p>{{ $empleado->apellidos }}</p>
    <p>{{ $empleado->dni }}</p>
    <p>{{ $empleado->cargo }}</p>
</x-profile>
@endsection
