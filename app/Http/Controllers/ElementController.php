<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;

class ElementController extends Controller
{

    //METODO GET

    /**
     * Lista todos los elementos del usuario autenticado
     * @authenticated
     * @header Authorization Bearer {token}
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $categoryId = $request->query('category_id');
    
        $elements = Element::whereHas('category', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });
    
        if ($categoryId) {
            $elements->where('category_id', $categoryId);
        }
    
        return response()->json($elements->get());
    }
    
    //METODO POST
    /**
     * Crea un nuevo elemento para el usuario autenticado
     * @authenticated
     * @header Authorization Bearer {token}
     * @bodyParam title string required
     * @bodyParam description string optional
     * @bodyParam classification integer required
     * @bodyParam image string optional
     * @bodyParam category_id integer required
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'classification'=> 'required|integer',
            'image'         => 'nullable|string',
            'category_id'   => 'required|integer|exists:categories,id',
        ]);

        // Crea el elemento asociado al usuario
        $element = $request->user()->elements()->create($validated);
        return response()->json($element, 201);
    }


    //METODO GET

    /**
     * Muestra un elemento específico del usuario
     * @authenticated
     * @header Authorization Bearer {token}
     */
    public function show(Request $request, $id)
    {
        $element = $request->user()->elements()->find($id);
        if (!$element) {
            return response()->json(['message' => 'Elemento no encontrado'], 404);
        }

        return response()->json($element);
    }


    //METODO DELETE
    /**
     * Elimina un elemento del usuario autenticado
     * @authenticated
     * @header Authorization Bearer {token}
     */
    public function destroy(Request $request, $id)
    {
        $element = $request->user()->elements()->find($id);
        if (!$element) {
            return response()->json(['message' => 'Elemento no encontrado'], 404);
        }

        $element->delete();
        return response()->json(['message' => 'Elemento eliminado']);
    }
}
