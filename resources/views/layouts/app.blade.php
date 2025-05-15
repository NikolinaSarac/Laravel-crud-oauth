<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD </title>
    <!-- Dodaj CSS, možeš koristiti Bootstrap ili neki drugi framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <!-- Navigacija (ako je potrebno) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">Početna</a>
        <a class="navbar-brand" href="{{ route('customers.index') }}">Kupci</a>
        <a class="navbar-brand" href="{{ route('products.index') }}">Proizvodi</a>
        <a class="navbar-brand" href="{{ route('categories.index') }}">Kategorije</a>
        <a class="navbar-brand" href="{{ route('colors.index') }}">Boje</a>
    </nav>

    <!-- Tu ide specifičan sadržaj koji se mijenja ovisno o page-u -->
    @yield('content')

</div>

<!-- Dodaj JS (ako je potrebno) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
