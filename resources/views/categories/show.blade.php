@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>

    <div class="mt-3">
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>

        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
