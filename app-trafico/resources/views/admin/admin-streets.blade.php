<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrar calles y avenidas</title>
    @include('utils.styles')
</head>
<body>
@include('admin.menu-admin')

<div class="container">
    @include('admin.add-street')
    @include('admin.list-streets')
</div>

@include('utils.footer-scripts')
</body>
</html>
