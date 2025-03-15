<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
    @include('utils.styles')
</head>
<body>
@include('admin.menu-admin')
<div class="container">
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar nuevo
        usuario
    </button>

    <!-- Modal structure -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Registro de usuario</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="m-3" action="{{ route('create.user') }}" method="post">
                        @csrf
                        <label for="inputPassword5" class="form-label">Nombre de usuario</label>
                        <input type="text" id="inputPassword5" class="form-control"
                               aria-describedby="passwordHelpBlock" required name="username">

                        <label for="inputPassword5" class="form-label">Contraseña</label>
                        <input type="password" id="inputPassword5" class="form-control"
                               aria-describedby="passwordHelpBlock" required name="password">

                        <label for="inputPassword5" class="form-label">Nombres</label>
                        <input type="text" id="inputPassword5" class="form-control"
                               aria-describedby="passwordHelpBlock" required name="nombres">

                        <label for="inputPassword5" class="form-label">Apellidos</label>
                        <input type="text" id="inputPassword5" class="form-control"
                               aria-describedby="passwordHelpBlock" required name="apellidos">

                        <label for="inputPassword5" class="form-label">Correo</label>
                        <input type="email" id="inputPassword5" class="form-control"
                               aria-describedby="passwordHelpBlock" required name="correo">

                        <label for="inputPassword5" class="form-label">Teléfono</label>
                        <input type="number" id="inputPassword5" class="form-control"
                               aria-describedby="passwordHelpBlock" required name="telefono">

                        <label for="exampleSelect1" class="form-label">Rol</label>
                        <select class="form-select" id="exampleSelect1" name="rol">
                            <option value="1">Monitor</option>
                            <option value="2">Supervisor</option>
                        </select>

                        <button type="submit" class="btn btn-dark mt-3 w-100">
                            Guardar cambios
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @include('utils.messages')
    @include('admin.list-users')
</div>
@include('utils.footer-scripts')
</body>
</html>
