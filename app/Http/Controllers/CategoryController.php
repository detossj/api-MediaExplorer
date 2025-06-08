<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get() {

        $categories = Category::all();
        return response()->json($categories);
    }

    public function getById() {

        $category = Category::find($id);
        if($category){
            return response()->json($category);
        }
        else {
            return response()->json(['message' => 'Category not find'], 404);
        }
    }

    public function create(Request $request) {

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

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
}
