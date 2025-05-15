@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dodaj novu boju</h1>

    <form action="{{ route('colors.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Naziv boje</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="products" class="form-label">Povezani proizvodi</label>
            <select name="products[]" class="form-select" multiple>
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Spremi</button>
        <a href="{{ route('colors.index') }}" class="btn btn-secondary">Natrag</a>
    </form>
</div>
@endsection
