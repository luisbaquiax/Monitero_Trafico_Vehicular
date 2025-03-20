<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoreo</title>
    @include('utils.styles')
</head>
<body>
@include('monitor.menu-monitor')
<div class="container">
    <a type="button" class="btn btn-dark mt-2" href="{{ route('monitor.home') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
             class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
            <path
                d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
        </svg>
        Regresar
    </a>
    @include('utils.messages')
    <div class="row mt-2 mb-3">
        <div class="col">
            <form action="{{ route('cargar.datos') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_interseccion" value="{{ $id_interseccion }}">
                <div class="mb-3">
                    <label for="archivo" class="form-label">Seleccione un archivo formato JSON</label>
                    <input class="form-control" type="file" id="archivo" name="archivo"
                           required accept=".json">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3 w-100">
                        Subir datos
                    </button>
                </div>
            </form>
        </div>
        <div class="col">
            <br>
            <form action="{{ route('monitor.datosRandom') }}" method="post">
                @csrf
                <input type="hidden" value="{{ $id_interseccion }}" name="id_interseccion">
                <button type="submit" class="btn btn-dark mt-2">
                    Generar datos aleatorios
                </button>
            </form>
        </div>
    </div>
</div>

@include('utils.footer-scripts')
</body>
</html>

