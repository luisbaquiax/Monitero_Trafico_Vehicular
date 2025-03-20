<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Monitoreo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor04"
                aria-controls="navbarColor04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor04">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">Archivos</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('monitor.home') }}">Cargar archivo</a>
                        <!-- <a class="dropdown-item" href="{{ route('monitor.myFiles') }}">Archivos cargados</a> -->
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">Reporte</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('monitor.home2') }}">Registros de archivos por intersección</a>
                    </div>
                </li>
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown" style="margin-right: 250px">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                           aria-haspopup="true" aria-expanded="false">Perfil</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">{{ session('user')->nombre_usuario }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('users.logout') }}">Salir</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
