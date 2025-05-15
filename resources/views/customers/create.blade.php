@extends('layouts.app')

@section('content')
<h1>Dodaj kupca</h1>

<form method="POST" action="{{ route('customers.store') }}">
    @csrf
    <input type="text" name="customerName" placeholder="Naziv kupca" required>
    <input type="text" name="contactLastName" placeholder="Prezime kontakt osobe" >
    <input type="text" name="contactFirstName" placeholder="Ime kontakt osobe" required>
    <input type="text" name="phone" placeholder="Telefon" required>
    <input type="text" name="addressLine1" placeholder="Adresa" required>
    <input type="text" name="city" placeholder="Grad" required>
    <input type="text" name="country" placeholder="Država" required>
    <button type="submit">Dodaj kupca</button>
</form>
@endsection
