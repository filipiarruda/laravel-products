<!DOCTYPE html>
<html>
<head>
    <title>Gerenciar Produtos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            CRUD de Produtos
        </a>
    </nav>
    <div id="app" class="container mt-4">
        @yield('content')
    </div>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
