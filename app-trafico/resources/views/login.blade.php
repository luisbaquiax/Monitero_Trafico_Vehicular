<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/litera/bootstrap.min.css"
          integrity="sha512-TUtnNUXMMWp2IALAR9t2z1vuorOUQL4dPWG3J9ANInEj6xu/rz5fzni/faoEGzuqeY1Z1yGD6COYAW72oiDVYA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
<div class="container d-flex justify-content-center" style="margin-top: 10%">
    <form class="w-50" action="{{ route('user.search') }}" method="post">
        @csrf
        <h1 class="text-center">Iniciar sesión</h1>
        <fieldset>
            <div>
                <label for="exampleInputEmail1" class="form-label mt-4">Nombre de usuario</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="Ingrese su nombre de usuario..." required name="username">
                <!--
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
                 -->
            </div>
            <div>
                <label for="exampleInputPassword1" class="form-label mt-4">Contraseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1"
                       placeholder="Ingrese la contraseña..." autocomplete="off" required name="password">
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-4">Ingresar</button>
        </fieldset>
    </form>

</div>
</body>
</html>
