@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Uredi proizvod</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Naziv:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Opis:</label>
            <textarea class="form-control" id="description" name="description" required>{{ $product->description }}</textarea>
        </div>
        <label for="category_id">Kategorija:</label>
        <select name="category_id" id="category_id" required>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>


        <div class="mb-3">
            <label for="price" class="form-label">Cijena:</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" step="0.01" required>
        </div>

        <h4 class="mt-4">Boje i količine:</h4>
        @foreach($colors as $color)
        @php
        $pivot = $product->colors->firstWhere('id', $color->id)?->pivot;
        @endphp
        <div class="mb-2">
            <label>
                <input
                    type="checkbox"
                    name="colors[{{ $color->id }}][selected]"
                    value="1"
                    {{ $pivot ? 'checked' : '' }}
                >
                {{ $color->name }}
            </label>
            <input
                type="number"
                name="colors[{{ $color->id }}][quantity]"
                placeholder="Količina"
                class="ml-2"
                min="0"
                value="{{ $pivot?->quantity }}"
            >
        </div>
        @endforeach


        <button type="submit" class="btn btn-primary">Ažuriraj</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Natrag</a>
    </form>
</div>
@endsection
