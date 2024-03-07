<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, int $postId)
    {
        $post = Post::where("postId", $postId)->get();
        $ids = [];
        foreach ($post->user_reagis as $reactor) {
            array_push($ids, $reactor->userId);
        }

        return response()->json(["ids"=>$ids], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = Post::create($request->only([
            "postId",
            "userId"
        ]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Reaction $reaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reaction $reaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reaction $reaction)
    {
        try {
            $reaction->delete();

            return response()->json(["deeted"=> true],200);
        } catch (\Exception $th) {
            return response()->json(["error"=> $th->getMessage()],500);
        }
    }
}
