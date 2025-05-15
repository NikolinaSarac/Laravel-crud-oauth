@extends('layouts.app')

@section('content')
<h1>Detalji kupca</h1>

<p>Ime: {{ $customer->customerName }}</p>
<p>Telefon: {{ $customer->phone }}</p>
<p>Grad: {{ $customer->city }}</p>

<a href="{{ route('customers.index') }}">Natrag</a>
@endsection
