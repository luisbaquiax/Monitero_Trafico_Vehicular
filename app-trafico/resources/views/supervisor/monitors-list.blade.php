<h3 class="text-center">Monitores</h3>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">Username</th>
        <th scope="col">Nombres</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Correo</th>
        <th scope="col">Telefono</th>
        <th scope="col">Informe</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->nombre_usuario }}</td>
            <td>{{ $user->nombres }}</td>
            <td>{{ $user->apellidos }}</td>
            <td>{{ $user->correo }}</td>
            <td>{{ $user->telefono }}</td>
            <td>
                <a type="button" class="btn btn-primary btn-sm"
                    href="{{ route('monitor.pruebas', ['id_usuario'=> $user->id]) }}">Pruebas</a>
                <a type="button" class="btn btn-warning btn-sm">Archivos</a>
                <a type="button" class="btn btn-info btn-sm"
                   href="{{ route('monitor.sessions', ['id_usuario'=> $user->id]) }}">Sesiones</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

