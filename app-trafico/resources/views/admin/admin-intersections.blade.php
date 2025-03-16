<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrar intersecciones</title>
    @include('utils.styles')
</head>
<body>
@include('admin.menu-admin')

<div class="container">
    @include('utils.messages')
    @include('admin.add-intersection')
    @include('admin.list-intercepts')
</div>

@include('utils.footer-scripts')
</body>
</html>
