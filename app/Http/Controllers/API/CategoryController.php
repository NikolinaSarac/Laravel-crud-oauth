<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @group Categories
     * Prikaz svih kategorija
     *
     * Dohvaća listu svih kategorija.
     *
     * @response 200 [
     *   {
     *     "id": 1,
     *     "name": "Elektronika",
     *     "description": "Sve o elektronici",
     *     "created_at": "2024-01-01T12:00:00Z",
     *     "updated_at": "2024-01-01T12:00:00Z"
     *   }
     * ]
     */
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    /**
     * @group Categories
     * Dodavanje nove kategorije
     *
     * Kreira novu kategoriju sa nazivom i opcionalnim opisom.
     *
     * @bodyParam name string required Naziv kategorije. Maksimalno 255 znakova. Example: "Elektronika"
     * @bodyParam description string|null Opis kategorije. Example: "Sve o elektronici"
     *
     * @response 201 {
     *   "id": 2,
     *   "name": "Elektronika",
     *   "description": "Sve o elektronici",
     *   "created_at": "2024-01-01T12:00:00Z",
     *   "updated_at": "2024-01-01T12:00:00Z"
     * }
     *
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "name": [
     *       "The name field is required."
     *     ]
     *   }
     * }
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    /**
     * @group Categories
     * Prikaz pojedine kategorije
     *
     * Prikazuje detalje jedne kategorije po ID-u.
     *
     * @urlParam category int required ID kategorije. Example: 1
     *
     * @response 200 {
     *   "id": 1,
     *   "name": "Elektronika",
     *   "description": "Sve o elektronici",
     *   "created_at": "2024-01-01T12:00:00Z",
     *   "updated_at": "2024-01-01T12:00:00Z"
     * }
     *
     * @response 404 {
     *   "message": "No query results for model [App\\Models\\Category] 999"
     * }
     */
    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    /**
     * @group Categories
     * Ažuriranje kategorije
     *
     * Ažurira postojeću kategoriju po ID-u.
     *
     * @urlParam category int required ID kategorije. Example: 1
     * @bodyParam name string required Novi naziv kategorije. Maksimalno 255 znakova. Example: "Gadgeti"
     * @bodyParam description string|null Novi opis kategorije. Example: "Sve o gadgetima"
     *
     * @response 200 {
     *   "id": 1,
     *   "name": "Gadgeti",
     *   "description": "Sve o gadgetima",
     *   "created_at": "2024-01-01T12:00:00Z",
     *   "updated_at": "2024-01-02T08:00:00Z"
     * }
     *
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "name": [
     *       "The name field is required."
     *     ]
     *   }
     * }
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return response()->json($category, 200);
    }

    /**
     * @group Categories
     * Brisanje kategorije
     *
     * Briše kategoriju po ID-u.
     *
     * @urlParam category int required ID kategorije. Example: 1
     *
     * @response 200 {
     *   "message": "Kategorija obrisana."
     * }
     *
     * @response 404 {
     *   "message": "No query results for model [App\\Models\\Category] 999"
     * }
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Kategorija obrisana.'],);
        }
}
