@extends('layouts.app')

@section('content')
<h2>Prijava korisnika</h2>

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="password">Lozinka:</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Prijavi se</button>
    <a href="{{ route('google.login') }}" class="btn btn-danger">Login with Google</a>

</form>
@endsection
