<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoreo</title>
    @include('utils.styles')
</head>
<body>
@include('supervisor.menu-supervisor')
<div class="container">
    <h3 class="text-center">Sesiones iniciadas por el usuario: {{ $monitor->nombre_usuario }}</h3>
    <a type="button" class="btn btn-dark" href="{{ route('monitors.list') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
             class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
            <path
                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
        Regresar
    </a>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Fecha</th>
            <th scope="col">Hora inicio</th>
            <th scope="col">Hora salida</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($sesiones as $sesion)
            <tr>
                <td>{{ $sesion->fecha }}</td>
                <td>{{ $sesion->hora_inicio }}</td>
                <td>{{ $sesion->hora_salida }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@include('utils.footer-scripts')
</body>
</html>
