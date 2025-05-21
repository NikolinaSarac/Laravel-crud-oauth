<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Dohvati sve proizvode
    public function index()
    {
        return response()->json(Product::all());
    }

    // Spremi novi proizvod
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

    // Prikaži proizvod po ID-u
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    // Ažuriraj proizvod
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

    // Obriši proizvod
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Proizvod obrisan.']);
    }
}
