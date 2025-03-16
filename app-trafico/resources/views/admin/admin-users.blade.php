<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
    @include('utils.styles')
</head>
<body>
@include('admin.menu-admin')
<div class="container">
    @include('admin.add-user')
    @include('utils.messages')
    @include('admin.list-users')
</div>
@include('utils.footer-scripts')
</body>
</html>
