<tr>
    <td>{{ $incidencia->latitud }}</td>
    <td>{{ $incidencia->longitud }}</td>
    <td>{{ $incidencia->ciudad }}</td>
    <td>{{ $incidencia->direccion }}</td>
    <td>{{ $incidencia->estado }}</td>
    <td>{{ $incidencia->nivel }}</td>
    <td>
        <a href="/incidencias/{{ $incidencia->id }}/delete"><button class="btn btn-primary"><i class="fas fa-trash-alt"></i></button></a>
        <a href="/incidencias/{{ $incidencia->id }}/edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
        <a href="/incidencias/{{ $incidencia->id }}"><button class="btn btn-primary"><i class="fas fa-binoculars"></i></button></a>
    </td>
</tr>
