@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalji boje</h1>

    <p><strong>Naziv:</strong> {{ $color->name }}</p>

    <p><strong>Povezani proizvodi:</strong></p>
    <ul>
        @forelse($color->products as $product)
        <li>{{ $product->name }}</li>
        @empty
        <li>Nema povezanih proizvoda.</li>
        @endforelse
    </ul>

    <a href="{{ route('colors.index') }}" class="btn btn-secondary">Natrag</a>
</div>
@endsection
