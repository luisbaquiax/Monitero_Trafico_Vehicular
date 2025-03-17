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
    <h3 class="text-center">Iteracciones realizadas por el usuario: {{ $monitor->nombre_usuario }}</h3>
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
            <th scope="col">Hora</th>
            <th scope="col">Tipo de archivo</th>
            <th scope="col">Revisión de resultados</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pruebas as $prueba)
            <tr>
                <td>{{ $prueba->fecha }}</td>
                <td>{{ $prueba->hora }}</td>
                <td>{{ $prueba->tipo_archivo->tipo }}</td>
                <td>
                    <a type="button" class="btn btn-warning btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                            <path
                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                        </svg>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@include('utils.footer-scripts')
</body>
</html>
