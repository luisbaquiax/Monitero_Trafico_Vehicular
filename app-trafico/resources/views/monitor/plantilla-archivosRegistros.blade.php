<h3 class="text-center">Archivos cargados</h3>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">Fecha de carga</th>
        <th scope="col">Intervalo de tiempo de registros</th>
        <th scope="col">
            @if(session('user')->id_rol == 1 || session('user')->id_rol == 3)
                Usuario
            @endif
        </th>
        <th scope="col">Tipo archivo</th>
        <th scope="col">Ver registros</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($archivos as $archivo)
        <tr>
            <td>{{ $archivo->fecha }}</td>
            <td>{{ $archivo->hora_inicio }} - {{ $archivo->hora_finalizacion }}</td>
            <td>
                @if(session('user')->id_rol == 1 || session('user')->id_rol == 3)
                    Usuario
                @endif
            </td>
            <td>{{ $archivo->tipo }}</td>
            <td>
                @include('supervisor/modal-registers')
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
