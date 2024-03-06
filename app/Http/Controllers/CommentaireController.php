<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($postid)
    {
        //
        return response()->json(Commentaire::where('postId', $postid)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $payload = JWTAuth::parseToken()->getPayload();
        $userId = $payload['userid'];

        $data = $request->only(["content", "postId"]);

        $comment = Commentaire::create([
            "content" => $data["content"],
            "userId" => $userId,
            "postId" => $data["postId"]
        ]);

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
    public function destroy(Commentaire $commentaire)
    {
        //
    }
}
