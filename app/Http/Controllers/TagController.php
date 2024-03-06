<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Tag::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $tag = Tag::create($request->only([
                "tagDesign",
            ]));

            return response()->json($tag, 201);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=>$th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        try {
            $tag->update($request->only([
                "tagDesign"
            ]));
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=>$th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
