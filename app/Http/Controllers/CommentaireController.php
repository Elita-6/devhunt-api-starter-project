<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($postid)
    {
        //
        $comments = [];
        $com = Commentaire::where('postId', $postid)->orderBy('created_at', 'asc')->get();
        foreach ($com as $comment)
            {
                $user = \App\Models\User::where('userId', $comment->userId)->first();
                array_push($comments, [
                    "comment" => $comment,
                    "user" => $user
                ]);
            }
        return response()->json($comments, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $userId = Auth::user()->userId;
        $gen = new GenUuid();
        $gen = $gen->genUuid();

        $data = $request->only(["content", "postId"]);

        $commentId = $gen;

        $comment = new Commentaire();

            $comment["commentId"] = $commentId;
            $comment["content"] = $data["content"];
            $comment["userId"] = $userId;
            $comment["postId"] = $data["postId"];
        $comment->save();

        return response()->json($comment, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        //
        $commentaire->content = $request->input('content');

        $commentaire->save();

        return response()->json($commentaire);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($commentaire)
    {
        //
        $com = Commentaire::where('commentId', $commentaire)->first();
        $com->delete();
        return response()->json(["message" => "deleted"], 201);
    }
}
