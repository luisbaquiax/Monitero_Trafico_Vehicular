<a type="button" class="btn btn-info" data-bs-toggle="modal"
   data-bs-target="#exampleModal{{ $archivo->id }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
         class="bi bi-eye-fill" viewBox="0 0 16 16">
        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
        <path
            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
    </svg>
</a>
<!-- Modal structure -->
<div class="modal modal-lg fade" id="exampleModal{{ $archivo->id }}" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Registros cargados</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3 class="text-center">Registro del flujo vehicular</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Nombre de interseccion</th>
                        <th scope="col">Tipo Vehículo</th>
                        <th scope="col">Velocidad</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Semaforo</th>
                        <th scope="col">Estado del Semáforo</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($archivo->registros as $registro)
                        <tr>
                            <td>{{ $registro->sensor->semaforo->interseccion->nombre }}</td>
                            <td>{{ $registro->tipo_vehiculo->tipo }}</td>
                            <td>{{ $registro->velocidad }}</td>
                            <td>{{ $registro->hora }}</td>
                            <td>{{ $registro->sensor->semaforo->orientacion->nombre }}</td>
                            <td>{{ $registro->estado_semaforo }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal structure end -->
