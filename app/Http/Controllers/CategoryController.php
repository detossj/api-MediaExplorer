<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //METODO GET

    /**
     * Lista las categorías del usuario autenticado
     * @authenticated
     * @header Authorization Bearer {token}
     */
    public function index(Request $request)
    {
        $categories = $request->user()->categories()->get();
        return response()->json($categories);
    }

    //METODO POST

    /**
     * Crea una nueva categoría para el usuario autenticado
     * @authenticated
     * @header Authorization Bearer {token}
     * @bodyParam title string required
     * @bodyParam icon integer optional
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon'  => 'nullable|integer',
        ]);

        $category = $request->user()->categories()->create($validated);
        return response()->json($category, 201);
    }

    //METODO DELETE

    /**
     * Elimina una categoría del usuario autenticado
     * @authenticated
     * @header Authorization Bearer {token}
     */
    public function destroy(Request $request, $id)
    {
        $category = $request->user()->categories()->find($id);
        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Categoría eliminada']);
    }
}
