<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administración</title>
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
    <h3 class="text-center">Lista de intersecciones</h3>
    <form action="{{ route('monitor.viewRegisgers') }}" method="post">
        @csrf
        <select class="form-select mb-2" id="exampleSelect1" name="id_interseccion">
            <@foreach($intersecciones as $interseccion)
                <option value="{{ $interseccion->id }}">{{ $interseccion->nombre }},
                    zona: {{ $interseccion->zona }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-dark mt-3 w-100">
            Ver registros vehicular
        </button>
    </form>
    <hr>
    <h3 class="text-center">Registro del flujo vehicular</h3>
    @if($registros)
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
    @endif
</div>
@include('utils.footer-scripts')
</body>
</html>

