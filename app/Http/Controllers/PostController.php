<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\TagPost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->only([
                "postTitle",
                "postDescription",
                "userId",
                "tags",
            ]);

            $post = Post::create([
                "postTitle"=>$data["postTitle"],
                "postDescription"=>$data["postDescription"],
                "userId" => $data["userId"],
            ]);

            foreach ($data["tags"] as $tag) {
                TagPost::create([
                    "tagId"=>$tag,
                    "postId"=>$post->postId
                ]);
            }

            return response()->json(["created"=>true], 201);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=>$th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        try {
            $data = $request->only([
                "postTitle",
                "postDescription",
            ]);

            $post->postTitle = $data["postTitle"];
            $post->postDescription = $data["postDescription"];

        } catch (\Exception $th) {
            return response()->json(["errorMessage"=>$th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
