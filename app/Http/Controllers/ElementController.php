<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElementController extends Controller
{
    /**
     * Se obtienen todas los elementos
     * @return \Illuminate\Http\JsonResponse
     */
    public function get() {

        $elements = Element::all();
        return response()->json($elements);
    }

    /**
     * Se obtiene un elemento por su id
     * @param int id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById() {

        $element = Element::find($id);
        if($element){
            return response()->json($element);
        }
        else {
            return response()->json(['message' => 'Element not find'], 404);
        }
    }

    /**
     * @bodyParam title string
     * @bodyParam description string
     * @bodyParam classification int
     * @bodyParam image string
     * @bodyParam category_id int
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request) {

        $element = Element::create($request->all());
        return response()->json($element, 201);
    }

    /**
     * Se actualiza un elemento
     * @bodyParam title string
     * @bodyParam description string
     * @bodyParam classification int
     * @bodyParam image string
     * @bodyParam category_id int
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {

        $element = Element::find($id);
        if($element) {
            $element->update($request->all());
            return response()->json($element);
        }
        else {
            return response()->json(['message' => 'Element not find'], 404);
        }
    }

     /**
     * Se elimina un elemento
     * @param int id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id) {

        $element = Element::find($id);
        if($element) {
            $element->delete();
            return response()->json(['message' => 'Element deleted']);
        }
        else {
            return response()->json(['message' => 'Element not find'], 404);
        }
        
    }
}
