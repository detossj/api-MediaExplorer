<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElementController extends Controller
{
    public function get() {

        $elements = Element::all();
        return response()->json($elements);
    }

    public function getById() {

        $element = Element::find($id);
        if($element){
            return response()->json($element);
        }
        else {
            return response()->json(['message' => 'Element not find'], 404);
        }
    }

    public function create(Request $request) {

        $element = Element::create($request->all());
        return response()->json($element, 201);
    }

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
