<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoreo</title>
    @include('utils.styles')
</head>
<body>
@include('monitor.menu-monitor')
<div class="container">
    <a type="button" class="btn btn-dark mt-2" href="javascript:history.back()">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
             class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
            <path
                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
        Regresar
    </a>
    <hr>
    @include('utils.messages')
    <h2 class="text-center">{{ $interseccion->nombre }}</h2>
    <h3 class="text-center">Resumen</h3>
    <strong>Velocidad Media de vehículos:</strong> {{ $velocidadMedia[0]->velocidad_media.' km/h' ?? '' }}
    <strong>Cantidad Vehículos:</strong> {{ $totalVehiculos[0]->cantidad_vehiculos ?? '' }}
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Semaforo</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Velocidad media</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cantidadPorSemaforo as $registro)
            <tr>
                <td>{{ $registro->orientacion }}</td>
                <td>{{ $registro->cantidad }}</td>
                <td>{{ $registro->velocidad_media }} km/h</td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Semaforo</th>
            <th scope="col">Tipo Vehiculo</th>
            <th scope="col">Cantidad</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cantidadPorSemaforVehiculo as $registro)
            <tr>
                <td>{{ $registro->orientacion }}</td>
                <td>{{ $registro->tipo_vehiculo }}</td>
                <td>{{ $registro->cantidad }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@include('utils.footer-scripts')
</body>
</html>
