<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $postId)
    {
        $post = Post::where("postId", $postId)->first();
        $ids = [];
        // dd($post);
        // if ($post->user_reagis != null){
            foreach ($post->user_reagis as $reactor) {
                array_push($ids, $reactor->userId);
            }
        // }

        return response()->json(["ids"=>$ids], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reactionExist = Reaction::where([
            "userId" => Auth::user()->userId,
            "postId" => $request->input("postId"),
            ])->exists();
        if($reactionExist) {

            Reaction::where([
                "userId" => Auth::user()->userId,
                "postId" => $request->input("postId"),
                ])->delete();


        } else {
            Reaction::create([
                "postId" => $request->input("postId"),
                "userId"=> Auth::user()->userId,
            ]);
        }
        return response()->json(201);
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
    public function destroy(Request $request, Reaction $reaction)
    {
        try {
            $reaction->delete();

            return response()->json(["deeted"=> true],200);
        } catch (\Exception $th) {
            return response()->json(["error"=> $th->getMessage()],500);
        }
    }
}
