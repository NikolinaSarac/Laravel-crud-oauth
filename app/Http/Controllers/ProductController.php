<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;

#[Middleware(['auth', 'role:admin,author'])]
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'colors'])->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        $colors = Color::all(); // ✅ Ispravno;

        return view('products.create', compact('categories', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($validated);

        // Obradi boje i količine
        if ($request->has('colors')) {
            $colorsData = [];

            foreach ($request->colors as $colorId => $colorInput) {
                if (isset($colorInput['selected']) && isset($colorInput['quantity'])) {
                    $colorsData[$colorId] = ['quantity' => $colorInput['quantity']];
                }
            }

            $product->colors()->attach($colorsData);
        }

        return redirect()->route('products.index')->with('success', 'Proizvod uspješno dodan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Product $product)
    {
        return view('products.show', compact('product'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $colors = Color::all(); // ✅ Dodaj ovo ako nije postojalo

        return view('products.edit', compact('product', 'categories', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validated);

        // Obradi boje
        $colorsData = [];

        if ($request->has('colors')) {
            foreach ($request->colors as $colorId => $colorInput) {
                if (isset($colorInput['selected']) && isset($colorInput['quantity'])) {
                    $colorsData[$colorId] = ['quantity' => $colorInput['quantity']];
                }
            }
        }

        // Sync boja (obriši stare, dodaj nove)
        $product->colors()->sync($colorsData);

        return redirect()->route('products.index')->with('success', 'Proizvod je ažuriran.');

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Dohvati proizvod prema ID-u
        $product = Product::find($id);

        // Provjeri da li proizvod postoji
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found');
        }

        // Obriši proizvod
        $product->delete();

        // Preusmjeri korisnika s porukom
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

}
