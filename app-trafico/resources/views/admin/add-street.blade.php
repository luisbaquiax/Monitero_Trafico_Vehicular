<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Registrar nueva calle
</button>

<!-- Modal structure -->
<div class="modal modal-lg fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Registro de nueva calle</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="m-3" action="{{ route('create.user') }}" method="post">
                    @csrf
                    <label for="inputPassword5" class="form-label">Nombre de la calle</label>
                    <input type="text" id="inputPassword5" class="form-control"
                           aria-describedby="passwordHelpBlock" required name="calle">

                    <label for="exampleSelect1" class="form-label">Tipo de calle</label>
                    <select class="form-select" id="exampleSelect1" name="tipo">
                        <option value="CALLE">Calle</option>
                        <option value="AVENIDA">Avenida</option>
                    </select>

                    <label for="inputPassword5" class="form-label">Zona</label>
                    <input type="number" id="inputPassword5" class="form-control"
                           min="1"
                           aria-describedby="passwordHelpBlock" required name="zona">

                    <button type="submit" class="btn btn-dark mt-3 w-100">
                        Guardar cambios
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
