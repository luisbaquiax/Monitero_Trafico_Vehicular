<h1 class="text-center">Calles y avenidas</h1>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">Nombre calle</th>
        <th scope="col">Tipo de calle</th>
        <th scope="col">Municipio</th>
        <th scope="col">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($calles as $calle)
        <tr>
            <td>{{ $calle->nombre_calle }}</td>
            <td>{{ $calle->tipo }}</td>
            <td>{{ $calle->municipio->nombre_municipio }}</td>
            <td>

                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalEditStreet{{ $calle->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd"
                              d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                </button>

                <!-- Modal structure -->
                <div class="modal modal-lg fade" id="modalEditStreet{{ $calle->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $calle->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel{{ $calle->id }}">Registro de nueva intersección</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="m-3" action="{{ route('edit.street') }}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{ $calle->id }}" name="id_calle">

                                    <label for="inputPassword5" class="form-label">Nombre de la calle</label>
                                    <input type="text" id="inputPassword5" class="form-control"
                                           aria-describedby="passwordHelpBlock" required name="nombre_calle"
                                            value="{{ $calle->nombre_calle }}">

                                    <label for="exampleSelect1" class="form-label">Tipo de calle: {{ $calle->tipo }}</label>
                                    <select class="form-select" id="exampleSelect1" name="tipo_calle">
                                        <option value="CALLE">Calle</option>
                                        <option value="AVENIDA">Avenida</option>
                                    </select>

                                    <button type="submit" class="btn btn-dark mt-3 w-100">
                                        Guardar cambios
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
