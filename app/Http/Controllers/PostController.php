<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\TagPost;
use App\Models\User;
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

        try {
            $posts = Post::orderBy("created_at","desc")->get();

            $data = [];


            foreach ($posts as $post) {
                $tags = [];
                $comments = [];
                // get tags
                foreach ($post->tags as $tag) {
//                dd("trigger ss");
                    array_push($tags, [$tag->tagDesign]);
                }

                // Get comments
                foreach ($post->comments as $comment) {

                    array_push($comments, [
                        "content" => $comment->content,
                        "dateComment" => $comment->created_at,
                        "user" => [
                            "userId"=> $comment->user->userId,
                            "userName" => $post->user->userName,
                            "firstName" => $post->user->firstName,
                            "profileUrl"=> $post->user->profileUrl,
                        ],
                    ]);
                }

                // Set all data together
                array_push($data, [
                    "postId" => $post->postId,
                    "postDescription" => $post->postDescription,
                    "dateCreation" => $post->created_at,
                    "user" => [
                        "userId" => $post->user->userId,
                        "userName" => $post->user->userName,
                        "firstName" => $post->user->firstName,
                        "profileUrl" => $post->user->profileUrl,
                    ],
                    "tags"=> $tags,
                    "comments" => $comments,
                ]);
            }

            return response()->json($data, 200);
        } catch (\Exception $th) {
            return response()->json([["errorMessage"=> $th->getMessage()]],500);
        }
    }


    public function filterByTag($tag){
        $posts = Post::whereHas('tags', function ($query) use ($tag) {
            $query->where('tagDesign', 'like', '%' .$tag. '%');
        })->get();

        $data = [];

        foreach ($posts as $post) {
            $tags = [];
            $comments = [];
            // get tags
            foreach ($post->tags as $tag) {
//                dd("trigger ss");
                array_push($tags, [$tag->tagDesign]);
            }

            // Get comments
            foreach ($post->comments as $comment) {

                array_push($comments, [
                    "content" => $comment->content,
                    "dateComment" => $comment->created_at,
                    "user" => [
                        "userId"=> $comment->user->userId,
                        "userName" => $post->user->userName,
                        "firstName" => $post->user->firstName,
                        "profileUrl"=> $post->user->profileUrl,
                    ],
                ]);
            }

            // Set all data together
            array_push($data, [
                "postId" => $post->postId,
                "postDescription" => $post->postDescription,
                "dateCreation" => $post->created_at,
                "user" => [
                    "userId" => $post->user->userId,
                    "userName" => $post->user->userName,
                    "firstName" => $post->user->firstName,
                    "profileUrl" => $post->user->profileUrl,
                ],
                "tags"=> $tags,
                "comments" => $comments,
            ]);
        }

        return response()->json($data, 200);
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
                // "userId",
                "tags",
            ]);
            $gen = new GenUuid();
            $userId = Auth::user()->userId;
            $post = Post::create([
                "postId" => $gen->genUuid(),
                "postTitle"=>$data["postTitle"],
                "postDescription"=>$data["postDescription"],
                "userId" => $userId,
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

        try {
            $data = [];
            $tags = [];
            $comments = [];

            // get tags
            foreach ($post->tags as $tag) {
                array_push($tags, [$tag->tagDesign]);
            }

            // Get comments
            foreach ($post->comments as $comment) {
                array_push($comments, [
                    "content" => $comment->content,
                    "user" => [
                        "userId"=> $comment->user->userId,
                        "userName" => $comment->user->userName,
                        "profileUrl"=> $comment->user->profileUrl,
                    ],
                ]);
            }

            // Set all data together
            array_push($data, [
                "postId" => $post->postId,
                "postDescription" => $post->postDescription,
                "dateCreation" => $post->created_at,
                "user" => [
                    "userId" => $post->user->userId,
                    "userName" => $post->user->userName,
                    "profileUrl" => $post->user->profileUrl,
                ],
                "tags"=> $tags,
                "comments" => $comments,
            ]);

            return response()->json($data, 200);
        } catch (\Exception $th) {
            return response()->json(["errorMessage"=>$th->getMessage()],500);
        }

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
        $post->delete();
        return response()->json(["message"=>"deleted"], 201);

    }
}
