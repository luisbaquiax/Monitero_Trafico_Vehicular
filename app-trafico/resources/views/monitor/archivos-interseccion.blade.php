<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoreo</title>
    @include('utils.styles')
</head>
<body>
@if(session('user')->id_rol == 2)
    @include('monitor.menu-monitor')
@endif
@if(session('user')->id_rol == 3)
    @include('supervisor.menu-supervisor')
@endif
<div class="container">
    <h2 class="text-center"> {{ $interseccion->nombre }}</h2>
    <h3 class="text-center">Archivos cargados</h3>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Fecha de carga</th>
            <th scope="col">Intervalo de tiempo de registros</th>
            <th scope="col">Usuario</th>
            <th scope="col">Tipo archivo</th>
            <th scope="col">Ver registros/Resumen</th>
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
                    <a class="btn btn-warning"
                       href="{{ route('ver.resumen', ['id_archivo' => $archivo->id, 'id_interseccion'=> $interseccion->id]) }}">Resumen</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@include('utils.footer-scripts')
</body>
</html><?php
