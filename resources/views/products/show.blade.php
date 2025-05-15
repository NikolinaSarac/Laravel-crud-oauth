@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $product->name }}</h1>
    <p class="mt-3"><strong>Opis:</strong> {{ $product->description }}</p>
    <p><strong>Cijena:</strong> ${{ $product->price }}</p>
    <p>Kategorija: {{ $product->category->name }}</p>

    <h4>Boje i količine:</h4>
    <ul>
        @foreach($product->colors as $color)
        <li>{{ $color->name }} - {{ $color->pivot->quantity }} kom</li>
        @endforeach
    </ul>



    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Uredi</a>

    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Obriši</button>
    </form>

    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Natrag</a>
</div>
@endsection
