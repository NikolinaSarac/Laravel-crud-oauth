@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Categories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>
    </div>

    @if($categories->count())
    <div class="list-group">
        @foreach($categories as $category)
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">{{ $category->name }}</h5>
                <p class="mb-1">{{ $category->description }}</p>
            </div>
            <div class="btn-group">
                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p>No categories available.</p>
    @endif
</div>
@endsection
