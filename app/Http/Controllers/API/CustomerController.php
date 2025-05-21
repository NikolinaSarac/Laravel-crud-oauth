<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return response()->json(Customers::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customerName' => 'required|string|max:50',
            'contactLastName' => 'required|string|max:50',
            'contactFirstName' => 'required|string|max:50',
            'phone' => 'required|string|max:50',
            'addressLine1' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'country' => 'required|string|max:50',
        ]);

        // Generiraj novi customerNumber (npr. max + 1)
        $maxCustomerNumber = Customers::max('customerNumber');
        $newCustomerNumber = $maxCustomerNumber ? $maxCustomerNumber + 1 : 1000;

        $customer = new Customers();
        $customer->customerNumber = $newCustomerNumber;
        $customer->customerName = $validated['customerName'];
        $customer->contactLastName = $validated['contactLastName'];
        $customer->contactFirstName = $validated['contactFirstName'];
        $customer->phone = $validated['phone'];
        $customer->addressLine1 = $validated['addressLine1'];
        $customer->city = $validated['city'];
        $customer->country = $validated['country'];
        $customer->save();

        return response()->json($customer, 201);
    }

    public function show($id)
    {
        $customer = Customers::findOrFail($id);
        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {
        $customer = Customers::findOrFail($id);

        $validated = $request->validate([
            'customerName' => 'sometimes|required|string|max:50',
            'contactLastName' => 'sometimes|required|string|max:50',
            'contactFirstName' => 'sometimes|required|string|max:50',
            'phone' => 'sometimes|required|string|max:50',
            'addressLine1' => 'sometimes|required|string|max:50',
            'city' => 'sometimes|required|string|max:50',
            'country' => 'sometimes|required|string|max:50',
        ]);

        $customer->update($validated);
        return response()->json($customer);
    }

    public function destroy($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();

        return response()->json(['message' => 'Customer deleted']);
    }
}
