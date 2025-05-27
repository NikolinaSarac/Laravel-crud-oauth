<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * @group Products
     * Dohvati sve proizvode
     *
     * Vraća JSON listu svih proizvoda iz baze.
     *
     * @response 200 [
     *   {
     *     "id": 1,
     *     "name": "Laptop",
     *     "description": "Opis proizvoda",
     *     "price": 2500.00,
     *     "category_id": 2,
     *     "created_at": "2024-05-25T12:00:00Z",
     *     "updated_at": "2024-05-25T12:00:00Z"
     *   }
     * ]
     */
    public function index()
    {
        return response()->json(Product::all());
    }

    /**
     * @group Products
     * Spremi novi proizvod
     *
     * Kreira novi proizvod sa zadanim podacima.
     *
     * @bodyParam name string required Naziv proizvoda. Example: "Laptop"
     * @bodyParam description string Opis proizvoda. Example: "Opis laptopa"
     * @bodyParam price number required Cijena proizvoda. Example: 2500.00
     * @bodyParam category_id integer required ID kategorije kojoj proizvod pripada. Example: 2
     *
     * @response 201 {
     *   "id": 3,
     *   "name": "Laptop",
     *   "description": "Opis laptopa",
     *   "price": 2500.00,
     *   "category_id": 2,
     *   "created_at": "2024-05-25T12:30:00Z",
     *   "updated_at": "2024-05-25T12:30:00Z"
     * }
     *
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "name": ["The name field is required."],
     *     "price": ["The price must be a number."]
     *   }
     * }
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($validatedData);

        return response()->json($product, 201);
    }

    /**
     * @group Products
     * Prikaži proizvod po ID-u
     *
     * Dohvaća detalje proizvoda prema ID-u.
     *
     * @urlParam id int required ID proizvoda. Example: 1
     *
     * @response 200 {
     *   "id": 1,
     *   "name": "Laptop",
     *   "description": "Opis proizvoda",
     *   "price": 2500.00,
     *   "category_id": 2,
     *   "created_at": "2024-05-25T12:00:00Z",
     *   "updated_at": "2024-05-25T12:00:00Z"
     * }
     *
     * @response 404 {
     *   "message": "No query results for model [App\\Models\\Product] 999"
     * }
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * @group Products
     * Ažuriraj proizvod
     *
     * Ažurira podatke proizvoda prema ID-u. Podaci nisu svi obavezni.
     *
     * @urlParam id int required ID proizvoda. Example: 1
     * @bodyParam name string Naziv proizvoda, max 255 znakova. Example: "Laptop Updated"
     * @bodyParam description string Opis proizvoda. Example: "Novi opis"
     * @bodyParam price number Cijena proizvoda, minimalno 0. Example: 2300.00
     *
     * @response 200 {
     *   "id": 1,
     *   "name": "Laptop Updated",
     *   "description": "Novi opis",
     *   "price": 2300.00,
     *   "category_id": 2,
     *   "created_at": "2024-05-25T12:00:00Z",
     *   "updated_at": "2024-05-25T13:00:00Z"
     * }
     *
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "price": ["The price must be at least 0."]
     *   }
     * }
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);
        return response()->json($product);
    }

    /**
     * @group Products
     * Obriši proizvod
     *
     * Briše proizvod iz baze prema ID-u.
     *
     * @urlParam id int required ID proizvoda. Example: 1
     *
     * @response 200 {
     *   "message": "Proizvod obrisan."
     * }
     *
     * @response 404 {
     *   "message": "No query results for model [App\\Models\\Product] 999"
     * }
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Proizvod obrisan.']);
    }
}
