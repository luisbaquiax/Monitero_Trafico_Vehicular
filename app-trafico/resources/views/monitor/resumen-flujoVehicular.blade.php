<h3 class="text-center">Resumen</h3>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">Semaforo</th>
        <th scope="col">Vehiculo</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Velocidad media</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($registros as $registro)
        <tr>
            <td>{{ $registro->sensor->semaforo->interseccion->nombre }}</td>
            <td>{{ $registro->tipo_vehiculo->tipo }}</td>
            <td>{{ $registro->velocidad }} km/h</td>
            <td>{{ $registro->hora }}</td>
            <td>{{ $registro->sensor->semaforo->orientacion->nombre }}</td>
            <td>{{ $registro->estado_semaforo }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
