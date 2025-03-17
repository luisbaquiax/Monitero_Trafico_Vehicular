<hr>
<h3 class="text-center">Registro del flujo vehicular</h3>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">Tipo Vehículo</th>
        <th scope="col">Velocidad</th>
        <th scope="col">Hora</th>
        <th scope="col">Estado del Semáforo</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($registros as $registro)
        <tr>
            <td>{{ $registro->tipo_vehiculo->tipo }}</td>
            <td>{{ $registro->velocidad }}</td>
            <td>{{ $registro->hora }}</td>
            <td>{{ $registro->estado_semaforo }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
