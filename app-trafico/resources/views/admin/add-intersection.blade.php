<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Registrar nueva intersección
</button>

<!-- Modal structure -->
<div class="modal modal-lg fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Registro de nueva intersección</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="m-3" action="{{ route('create.intersection') }}" method="post">
                    @csrf
                    <label for="exampleSelect1" class="form-label">Calle</label>
                    <select class="form-select mb-2" id="exampleSelect1" name="calle_interseccion">
                        @foreach($calles as $calle)
                            <option value="{{ $calle->id }}">{{ $calle->nombre_calle }}</option>
                        @endforeach
                    </select>

                    <label for="exampleSelect1" class="form-label">Avenida</label>
                    <select class="form-select mb-2" id="exampleSelect1" name="avenida_interseccion">
                        <@foreach($avenidas as $calle)
                            <option value="{{ $calle->id }}">{{ $calle->nombre_calle }}</option>
                        @endforeach
                    </select>

                    <label for="exampleSelect1" class="form-label">Zona</label>
                    <select class="form-select mb-2" id="exampleSelect1" name="numero_zona">
                        <@foreach($zonas as $zona)
                            <option value="{{ $zona->numero_zona }}">{{ $zona->numero_zona }}</option>
                        @endforeach
                    </select>

                    <div class="text-center">
                        <button type="submit" class="btn btn-dark mt-3 w-50">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
