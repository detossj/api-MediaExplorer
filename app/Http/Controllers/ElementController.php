<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Element;

class ElementController extends Controller
{
    /**
     * Lista todos los elementos
     */
    public function index()
    {
        return response()->json(Element::all());
    }

    /**
     * Muestra un elemento por ID
     */
    public function show($id)
    {
        $element = Element::find($id);
        if (!$element) {
            return response()->json(['message' => 'Elemento no encontrado'], 404);
        }

        return response()->json($element);
    }

    /**
     * Crea un nuevo elemento
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

        $element = Element::create($validated);
        return response()->json($element, 201);
    }

    /**
     * Actualiza un elemento existente
     */
    public function update(Request $request, $id)
    {
        $element = Element::find($id);
        if (!$element) {
            return response()->json(['message' => 'Elemento no encontrado'], 404);
        }

        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'classification'=> 'required|integer',
            'image'         => 'nullable|string',
            'category_id'   => 'required|integer|exists:categories,id',
        ]);

        $element->update($validated);
        return response()->json($element);
    }

    /**
     * Elimina un elemento
     */
    public function destroy($id)
    {
        $element = Element::find($id);
        if (!$element) {
            return response()->json(['message' => 'Elemento no encontrado'], 404);
        }

        $element->delete();
        return response()->json(['message' => 'Elemento eliminado']);
    }
}
