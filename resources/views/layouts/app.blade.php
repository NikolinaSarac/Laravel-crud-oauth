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
    @auth
    <div>
        Prijavljeni ste kao: <strong>{{ Auth::user()->name }}</strong> (rola: {{ Auth::user()->role }})
    </div>
    @endauth
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
    <!-- Link za login -->
    <a href="{{ route('login.form') }}">
        <button>Prijava</button>
    </a>

    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Odjava
    </a>

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
