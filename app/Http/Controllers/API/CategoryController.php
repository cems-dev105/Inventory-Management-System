<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryList = Category::all();

        return response()->json([
            'status' => 'success',
            'message' => 'All category list..',
            'data' => $categoryList
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255'
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully!',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if ($category)
        {

            return response()->json([
                'status' => 'success',
                'message' => 'Category found!',
                'data' => $category
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found!',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoryUpdate = Category::find($id);

        if($categoryUpdate)
        {

            $categoryUpdate->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Category Updated!',
                'data' => $categoryUpdate
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found!',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoryDelete = Category::find($id);

        if ($categoryDelete)
        {
            $categoryDelete->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted successfully!',
                'data' => $categoryDelete
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found!',
            ], 404);
        }
    }
}
