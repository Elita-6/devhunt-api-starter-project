<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->only([
                "categoryDesign",
                "icon",
            ]);

            $category = Category::create([
                "categoryId",
                "categoryDesign",
                "icon"
            ]);

            return response()->json($category, 201);
        } catch (\Exception $th) {
            return response()->json(["errorMessage" => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try {
            $data = $category->update($request->only([
                "categoryDesign",
                "icon"
            ]));

            return response()->json($category, 200);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json(["deleted"=> true], 204);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=> $th->getMessage()], 500);
        }
    }
}
