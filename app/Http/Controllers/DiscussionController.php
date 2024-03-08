<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\GenUuid;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return response()->json(Message::all(), 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $userId = Auth::user()->userId;
        $data = $request->only(["discussionTitle"]);
        $discussionId = new GenUuid();
        $discussionId = $discussionId->genUuid();

            $discussion = Discussion::firstOrCreate(["userId", $userId],
                [
                    "discussionTitle" => $data['discussionTitle'],
                    "userId" => $userId
                ]
            );

        return response()->json($discussion, 200);
    }



    /**
     * Display the specified resource.
     */
    public function show(Discussion $discussion)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discussion $discussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discussion $discussion)
    {
        //
    }
}
