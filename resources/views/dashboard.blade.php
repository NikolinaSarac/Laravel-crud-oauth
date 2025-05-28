@extends('layouts.app')

@section('content')
<h2>Dobrodošli na Dashboard</h2>

<div class="row">
    <div class="col-md-3 mb-3">
        <a href="{{ route('customers.index') }}" class="btn btn-outline-primary btn-block">Kupci</a>
    </div>
    <div class="col-md-3 mb-3">
        <a href="{{ route('products.index') }}" class="btn btn-outline-success btn-block">Proizvodi</a>
    </div>
    <div class="col-md-3 mb-3">
        <a href="{{ route('categories.index') }}" class="btn btn-outline-warning btn-block">Kategorije</a>
    </div>
    <div class="col-md-3 mb-3">
        <a href="{{ route('colors.index') }}" class="btn btn-outline-info btn-block">Boje</a>
    </div>
</div>
@endsection
