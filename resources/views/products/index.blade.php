@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Proizvodi</h1>

    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">+ Novi proizvod</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Naziv</th>
            <th>Opis</th>
            <th>Cijena</th>
            <th>Kategorija</th>
            <th>Boje (količina)</th>
            <th>Akcije</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
        <tr>
            <td><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></td>
            <td>{{ $product->description }}</td>
            <td>${{ $product->price }}</td>
            <td>{{ $product->category ? $product->category->name : 'No category' }}</td>
            <td>
                @forelse($product->colors as $color)
                <span class="badge bg-info text-dark">
                        {{ $color->name }} ({{ $color->pivot->quantity }})
                    </span>
                @empty
                <span class="text-muted">Nema boja</span>
                @endforelse
            </td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Uredi</a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Obriši</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
