<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * @group Customers
     * Prikaz svih kupaca
     *
     * Dohvaća listu svih kupaca iz baze.
     *
     * @response 200 [
     *   {
     *     "customerNumber": 1001,
     *     "customerName": "ACME Corp",
     *     "contactLastName": "Smith",
     *     "contactFirstName": "John",
     *     "phone": "123-456-7890",
     *     "addressLine1": "123 Elm St",
     *     "city": "Zagreb",
     *     "country": "Croatia",
     *     "created_at": "2024-01-01T12:00:00Z",
     *     "updated_at": "2024-01-01T12:00:00Z"
     *   }
     * ]
     */
    public function index()
    {
        return response()->json(Customers::all(), 200);
    }

    /**
     * @group Customers
     * Kreiranje novog kupca
     *
     * Kreira novog kupca sa svim obaveznim podacima.
     * Automatski generira jedinstveni customerNumber (max + 1 ili 1000 ako nema kupaca).
     *
     * @bodyParam customerName string required Ime kupca, max 50 znakova. Example: "ACME Corp"
     * @bodyParam contactLastName string required Prezime kontakt osobe, max 50 znakova. Example: "Smith"
     * @bodyParam contactFirstName string required Ime kontakt osobe, max 50 znakova. Example: "John"
     * @bodyParam phone string required Telefon, max 50 znakova. Example: "123-456-7890"
     * @bodyParam addressLine1 string required Adresa, max 50 znakova. Example: "123 Elm St"
     * @bodyParam city string required Grad, max 50 znakova. Example: "Zagreb"
     * @bodyParam country string required Država, max 50 znakova. Example: "Croatia"
     *
     * @response 201 {
     *   "customerNumber": 1002,
     *   "customerName": "ACME Corp",
     *   "contactLastName": "Smith",
     *   "contactFirstName": "John",
     *   "phone": "123-456-7890",
     *   "addressLine1": "123 Elm St",
     *   "city": "Zagreb",
     *   "country": "Croatia",
     *   "created_at": "2024-05-25T12:00:00Z",
     *   "updated_at": "2024-05-25T12:00:00Z"
     * }
     *
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "customerName": ["The customer name field is required."]
     *   }
     * }
     */
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

    /**
     * @group Customers
     * Prikaz pojedinog kupca
     *
     * Dohvaća detalje kupca prema ID-u (customerNumber).
     *
     * @urlParam id int required ID kupca. Example: 1001
     *
     * @response 200 {
     *   "customerNumber": 1001,
     *   "customerName": "ACME Corp",
     *   "contactLastName": "Smith",
     *   "contactFirstName": "John",
     *   "phone": "123-456-7890",
     *   "addressLine1": "123 Elm St",
     *   "city": "Zagreb",
     *   "country": "Croatia",
     *   "created_at": "2024-01-01T12:00:00Z",
     *   "updated_at": "2024-01-01T12:00:00Z"
     * }
     *
     * @response 404 {
     *   "message": "No query results for model [App\\Models\\Customers] 9999"
     * }
     */
    public function show($id)
    {
        $customer = Customers::findOrFail($id);
        return response()->json($customer);
    }

    /**
     * @group Customers
     * Ažuriranje kupca
     *
     * Ažurira postojeće podatke kupca prema ID-u. Nisu svi podaci obavezni prilikom ažuriranja.
     *
     * @urlParam id int required ID kupca. Example: 1001
     * @bodyParam customerName string Naziv kupca, max 50 znakova. Example: "ACME Updated"
     * @bodyParam contactLastName string Prezime kontakt osobe, max 50 znakova. Example: "Smith"
     * @bodyParam contactFirstName string Ime kontakt osobe, max 50 znakova. Example: "John"
     * @bodyParam phone string Telefon, max 50 znakova. Example: "123-456-7890"
     * @bodyParam addressLine1 string Adresa, max 50 znakova. Example: "123 Elm St"
     * @bodyParam city string Grad, max 50 znakova. Example: "Zagreb"
     * @bodyParam country string Država, max 50 znakova. Example: "Croatia"
     *
     * @response 200 {
     *   "customerNumber": 1001,
     *   "customerName": "ACME Updated",
     *   "contactLastName": "Smith",
     *   "contactFirstName": "John",
     *   "phone": "123-456-7890",
     *   "addressLine1": "123 Elm St",
     *   "city": "Zagreb",
     *   "country": "Croatia",
     *   "created_at": "2024-01-01T12:00:00Z",
     *   "updated_at": "2024-05-25T14:00:00Z"
     * }
     *
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "customerName": ["The customer name field is required when present."]
     *   }
     * }
     */
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

    /**
     * @group Customers
     * Brisanje kupca
     *
     * Briše kupca iz baze prema ID-u.
     *
     * @urlParam id int required ID kupca. Example: 1001
     *
     * @response 200 {
     *   "message": "Customer deleted"
     * }
     *
     * @response 404 {
     *   "message": "No query results for model [App\\Models\\Customers] 9999"
     * }
     */
    public function destroy($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();

        return response()->json(['message' => 'Customer deleted']);
    }
}
