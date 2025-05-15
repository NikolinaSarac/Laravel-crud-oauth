@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Popis boja</h1>

    <a href="{{ route('colors.create') }}" class="btn btn-primary mb-3">Dodaj novu boju</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Naziv boje</th>
            <th>Proizvodi</th>
            <th>Akcije</th>
        </tr>
        </thead>
        <tbody>
        @foreach($colors as $color)
        <tr>
            <td>{{ $color->name }}</td>
            <td>
                @foreach($color->products as $product)
                <span class="badge bg-secondary">{{ $product->name }}</span>
                @endforeach
            </td>
            <td>
                <a href="{{ route('colors.show', $color) }}" class="btn btn-info btn-sm">Prikaži</a>
                <a href="{{ route('colors.edit', $color) }}" class="btn btn-warning btn-sm">Uredi</a>
                <form action="{{ route('colors.destroy', $color) }}" method="POST" class="d-inline" onsubmit="return confirm('Jeste li sigurni?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Obriši</button>

                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
