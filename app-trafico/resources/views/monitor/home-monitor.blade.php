<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoreo</title>
    @include('utils.styles')
</head>
<body>
@if(session('user')->id_rol == 2)
    @include('monitor.menu-monitor')
@endif
@if(session('user')->id_rol == 3)
    @include('supervisor.menu-supervisor')
@endif
<div class="container">
    @if($form == 1)
        @include('monitor.form-intersections')
    @endif
    @if($form == 2)
        @include('monitor.form2-intersections')
    @endif
</div>
@include('utils.footer-scripts')
</body>
</html>
