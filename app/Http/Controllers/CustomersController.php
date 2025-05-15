<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customers::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customerName' => 'required|string|max:50',
            'contactLastName' => 'required|string|max:50',
            'contactFirstName' => 'required|string|max:50',
            'phone' => 'required|string|max:50',
            'addressLine1' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'country' => 'required|string|max:50',
        ]);

        // Ručno generiraj customerNumber (samo ako nije auto increment u bazi!)
        $lastCustomer = Customers::orderBy('customerNumber', 'desc')->first();
        $newCustomerNumber = $lastCustomer ? $lastCustomer->customerNumber + 1 : 1000;

        Customers::create([
            'customerNumber' => $newCustomerNumber,
            'customerName' => $request->customerName,
            'contactLastName' => $request->contactLastName,
            'contactFirstName' => $request->contactFirstName,
            'phone' => $request->phone,
            'addressLine1' => $request->addressLine1,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        return redirect()->route('customers.index')->with('success', 'Kupac uspješno dodan!');
    }




    public function show(Customers $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customers $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customers $customer)
    {
        $request->validate([
            'customerName' => 'required',
            'phone' => 'required',
            'city' => 'required'
        ]);

        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success', 'Kupac uspješno ažuriran!');
    }

    public function destroy(Customers $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Kupac obrisan!');
    }
}
