@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Poruka o uspješnom dodavanju --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Popis kupaca</h2>
        <a href="{{ route('customers.create') }}" class="btn btn-primary">Dodaj novog kupca</a>
    </div>

    {{-- Tabela s kupcima --}}
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Broj kupca</th>
            <th>Ime</th>
            <th>Telefon</th>
            <th>Grad</th>
            <th>Akcije</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($customers as $customer)
        <tr>
            <td>{{ $customer->customerNumber }}</td>
            <td>{{ $customer->customerName }}</td>
            <td>{{ $customer->phone }}</td>
            <td>{{ $customer->city }}</td>
            <td>
                <a href="{{ route('customers.show', $customer->customerNumber) }}" class="btn btn-sm btn-info">Prikaži</a>
                <a href="{{ route('customers.edit', $customer->customerNumber) }}" class="btn btn-sm btn-warning">Uredi</a>
                <form action="{{ route('customers.destroy', $customer->customerNumber) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Jesi siguran?')">Obriši</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

</div>
@endsection
