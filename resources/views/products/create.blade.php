@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dodaj novi proizvod</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Naziv:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Opis:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <label for="category_id">Kategorija:</label>
        <select name="category_id" id="category_id" required>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <div class="mb-3">
            <label for="price" class="form-label">Cijena:</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Boje</label>
            @foreach($colors as $color)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="colors[]" value="{{ $color->id }}" id="color{{ $color->id }}">
                <label class="form-check-label" for="color{{ $color->id }}">
                    {{ $color->name }}
                </label>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Spremi</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Natrag</a>
    </form>
</div>
@endsection
