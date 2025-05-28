<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Auth\Middleware\Authenticate;

use Illuminate\Routing\Attributes\Middleware;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('role:category.create')->only(['create', 'store']);
        $this->middleware('role:category.update')->only(['edit', 'update']);
        $this->middleware('role:category.delete')->only('destroy');
    }
    public function index()
    {
        //
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }


    public function create()
    {
        //
        return view('categories.create');
    }


    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategorija dodana.');
    }

    public function show(Category $category)
    {
        //
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        //
        return view('categories.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategorija ažurirana.');
    }

    public function destroy(Category $category)
    {
        //
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategorija obrisana.');
    }
}
