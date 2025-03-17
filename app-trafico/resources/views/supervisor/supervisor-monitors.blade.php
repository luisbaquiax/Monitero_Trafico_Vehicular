<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitores</title>
    @include('utils.styles')
</head>
<body>
@if(session('user')->id_rol == 1)
    @include('admin.menu-admin')
@endif
@if(session('user')->id_rol == 3)
    @include('supervisor.menu-supervisor')
@endif
<div class="container">
    @include('utils.messages')
    @include('supervisor.monitors-list')
</div>
@include('utils.footer-scripts')
</body>
</html>
