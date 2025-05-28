<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Product;

#[Middleware(['auth', 'role:admin,author'])]
class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::with('products')->get();
        return view('colors.index', compact('colors'));
    }

    public function create()
    {
        $products = Product::all();
        return view('colors.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'products' => 'array',
        ]);

        $color = Color::create([
            'name' => $request->name,
        ]);

        if ($request->has('products')) {
            $color->products()->attach($request->products);
        }

        return redirect()->route('colors.index')->with('success', 'Boja uspješno dodana.');
    }

    // ✅ Route model binding
    public function show(Color $color)
    {
        $color->load('products');
        return view('colors.show', compact('color'));
    }

    public function edit(Color $color)
    {
        $products = Product::all();
        $selectedProducts = $color->products->pluck('id')->toArray();
        return view('colors.edit', compact('color', 'products', 'selectedProducts'));
    }

    public function update(Request $request, Color $color)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'products' => 'array',
        ]);

        $color->update([
            'name' => $request->name,
        ]);

        $color->products()->sync($request->products);

        return redirect()->route('colors.index')->with('success', 'Boja uspješno ažurirana.');
    }

    public function destroy(Color $color)
    {
        $color->products()->detach();
        $color->delete();

        return redirect()->route('colors.index')->with('success', 'Boja uspješno obrisana.');
    }
}
