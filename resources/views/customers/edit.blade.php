@extends('layouts.app')

@section('content')
<h1>Uredi kupca</h1>

<form action="{{ route('customers.update', $customer->customerNumber) }}" method="POST">
    @csrf
    @method('PUT')
    Ime: <input type="text" name="customerName" value="{{ $customer->customerName }}"><br>
    Telefon: <input type="text" name="phone" value="{{ $customer->phone }}"><br>
    Grad: <input type="text" name="city" value="{{ $customer->city }}"><br>
    <button type="submit">Ažuriraj</button>
</form>
@endsection
