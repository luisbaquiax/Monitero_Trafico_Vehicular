<h3 class="text-center">Usuarios</h3>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">Username</th>
        <th scope="col">Nombres</th>
        <th scope="col">Apellidos</th>
        <th scope="col">Correo</th>
        <th scope="col">Telefono</th>
        <th scope="col">Rol</th>
        <th scope="col">Estado</th>
        <th scope="col">Acción</th>
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
                @if($user->id_rol == 2)
                    MONITOR
                @endif
                @if($user->id_rol == 3)
                    SUPERVISOR
                @endif
            </td>
            <td>
                @if($user->estado == 1)
                    ACTIVO
                @endif
                @if($user->estado == 0)
                    BANEADO
                @endif
            </td>
            <td>
                <a class="btn btn-danger"
                   href="{{ route('delete.user', ['id_user'=>$user->id]) }}"
                   onclick=" return confirm('¿Quieres banear al usuario?')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-trash3" viewBox="0 0 16 16">
                        <path
                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                    </svg>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
