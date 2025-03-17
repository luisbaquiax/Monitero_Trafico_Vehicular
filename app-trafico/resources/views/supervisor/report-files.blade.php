<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoreo</title>
    @include('utils.styles')
</head>
<body>

@if(session('user')->id_rol == 1)
    @include('admin.menu-admin')
@endif
@if(session('user')->id_rol == 3)
    @include('supervisor.menu-supervisor')
@endif
<div class="container">
    <h3 class="text-center">Archivos cargados por: {{ $monitor->nombre_usuario }}</h3>
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
            <th scope="col">Fecha de carga</th>
            <th scope="col">Intervalo de tiempo de registros</th>
            <th scope="col">Usuario</th>
            <th scope="col">Tipo archivo</th>
            <th scope="col">Ver registros</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($archivos as $archivo)
            <tr>
                <td>{{ $archivo->fecha }}</td>
                <td>{{ $archivo->hora_inicio }} - {{ $archivo->hora_finalizacion }}</td>
                <td>{{ $archivo->usuario->nombre_usuario }}</td>
                <td>{{ $archivo->tipo }}</td>
                <td>
                    @include('supervisor/modal-registers')
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@include('utils.footer-scripts')
</body>
</html>
