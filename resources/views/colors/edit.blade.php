@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Uredi boju</h1>

    <form action="{{ route('colors.update', $color) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Naziv boje</label>
            <input type="text" name="name" class="form-control" value="{{ $color->name }}" required>
        </div>

        <div class="mb-3">
            <label for="products" class="form-label">Povezani proizvodi</label>
            <select name="products[]" class="form-select" multiple>
                @foreach($products as $product)
                <option value="{{ $product->id }}" @if(in_array($product->id, $selectedProducts)) selected @endif>
                    {{ $product->name }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Ažuriraj</button>
        <a href="{{ route('colors.index') }}" class="btn btn-secondary">Natrag</a>
    </form>
</div>
@endsection
