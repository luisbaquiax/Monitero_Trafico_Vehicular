<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitores</title>
    @include('utils.styles')
</head>
<body>
@include('supervisor.menu-supervisor')
<div class="container">
    @include('utils.messages')
    @include('supervisor.monitors-list')
</div>
@include('utils.footer-scripts')
</body>
</html>
