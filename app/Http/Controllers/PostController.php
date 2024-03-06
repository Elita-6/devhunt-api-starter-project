<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

//        dd(Auth::user());

        return response()->json(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $payload = JWTAuth::parseToken()->getPayload();
        $userId = $payload['userid'];

        $data = $request->only(["postTitle", "postDescription"]);


        $post = Post::create([
            "posttitle" => $data['postTitle'],
            "postDescription" => $data['postDescription'],
            "userId" => $userId,
        ]);

        return response()->json($post, 201);

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
        //
        $payload = JWTAuth::parseToken()->getPayload();
        $userId = $payload['userid'];

        $data = $request->only(["postTitle", "postDescription"]);
        $post->postTitle = $data['postTitle'];
        $post->postDescription = $data['postDescription'];
        $post->save();

        return response()->json($post, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return response()->json(["message"=>"deleted"], 201);

    }
}
