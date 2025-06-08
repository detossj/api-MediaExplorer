<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
     /**
     * Se obtienen todas las categorias
     * @return \Illuminate\Http\JsonResponse
     */
    public function get() {

        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Se obtiene una categoria por su id
     * @param int id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById($id) {

        $category = Category::find($id);
        if($category){
            return response()->json($category);
        }
        else {
            return response()->json(['message' => 'Category not find'], 404);
        }
    }

    /**
     * @bodyParam title string
     * @bodyParam icon string
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request) {

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

     /**
     * Se actualiza una categoria
     * @bodyParam title string
     * @bodyParam icon string
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {

        $category = Category::find($id);
        if($category) {
            $category->update($request->all());
            return response()->json($category);
        }
        else {
            return response()->json(['message' => 'Category not find'], 404);
        }
    }

    /**
     * Se elimina una categoria
     * @param int id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id) {

        $category = Category::find($id);
        if($category) {
            $category->delete();
            return response()->json(['message' => 'Category deleted']);
        }
        else {
            return response()->json(['message' => 'Category not find'], 404);
        }
        
    }

    /**
     * @authenticated
     * @header Authorization Bearer {token}
     * @bodyParam nombre string required
     * @bodyParam descripcion string nullable
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'icon' => 'nullable|string',
        ]);

        $category = $request->user()->categories()->create($request->only('title', 'icon'));

        return response()->json($category, 201);
    }

    /**
     * @authenticated
     * @header Authorization Bearer {token}
     */
    public function index(Request $request)
    {
        $categories = $request->user()->categories()->get();

        return response()->json($categories);
    }
}
