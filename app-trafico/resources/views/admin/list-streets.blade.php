<h1 class="text-center">Calles y avenidas</h1>
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">Nombre calle</th>
        <th scope="col">Tipo de calle</th>
        <th scope="col">Municipio</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($calles as $calle)
        <tr>
            <td>{{ $calle->nombre_calle }}</td>
            <td>{{ $calle->tipo }}</td>
            <td>{{ $calle->municipio->nombre_municipio }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
