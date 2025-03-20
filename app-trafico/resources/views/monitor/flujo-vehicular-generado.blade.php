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
    @include('utils.messages')
    <div class="row">
        <div class="col">
            @include('monitor.plantilla-flujoVehicular')
        </div>
        <div class="col">
            @include('monitor.resumen-flujoVehicular')
        </div>
    </div>
</div>
@include('utils.footer-scripts')
</body>
</html>
