<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($discussion)
    {
        //
        return response()->json(Message::where('discussionId', $discussion)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $discussion)
    {
        //
        $payload = JWTAuth::parseToken()->getPayload();
        $userId = $payload['userid'];

        $data = $request->only(["messageContent", "isBot"]);
        $messageId = new GenUuid();
        $messageId = $messageId->genUuid();

        $message1 = Message::create([
            "userId" => $userId,
            "messageContent" => $data["messageContent"],
            "isBot" => $data["isBot"],
            "discussionId" => $discussion
        ]);

        $prompt = $data["messageContent"];
        $response = $this->chatGPTService->getChatGPTResponse($prompt);

        $message2 = Message::create([
            "userID" => $userId,
            "messageContent" => $response->original,
            "discussionId" => $discussion
        ]);

        return response()->json(["prompt"=>$message1, "reply"=>$message2], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
