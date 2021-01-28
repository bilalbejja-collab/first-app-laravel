@extends('layouts.app')

@section('content')
<x-profile title="Incidencia">
    <p>{{ $incidencia->latitud }}</p>
    <p>{{ $incidencia->longitud }}</p>
    <p>{{ $incidencia->direccion }}</p>
    <p>{{ $incidencia->estado }}</p>
    <p>{{ $incidencia->nivel }}</p>
</x-profile>
@endsection
