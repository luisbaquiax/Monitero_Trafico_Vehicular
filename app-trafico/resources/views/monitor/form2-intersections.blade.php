<h3 class="text-center">Lista de intersecciones</h3>
<form action="{{ route('monitor.archivosInterseccion') }}" method="post">
    @csrf
    <select class="form-select mb-2" id="exampleSelect1" name="id_interseccion">
        <@foreach($intersecciones as $interseccion)
            <option value="{{ $interseccion->id }}">{{ $interseccion->nombre }},
                zona: {{ $interseccion->zona }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-dark mt-3 w-100">
        Seleccionar intersección
    </button>
</form>
