
<h3 class="text-center">Intersecciones</h3>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Calle</th>
        <th scope="col">Avenida</th>
        <th scope="col">Zona</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($intersecciones as $interseccion)
            <tr>
                <td>{{ $interseccion->nombre }} </td>
                <td>{{ $interseccion->calle ? $interseccion->calle->nombre_calle : 'Sin Calle' }}</td>
                <td>{{ $interseccion->avenida ? $interseccion->avenida->nombre_calle : 'Sin Avenida' }}</td>
                <td>{{ $interseccion->zona }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
