<?php

namespace App\Http\Controllers;

use App\Http\Services\ChatGPTService;
use App\Models\Discussion;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
    //
    protected $chatGPTService;

    public function __construct(ChatGPTService $chatGPTService)
    {
        $this->chatGPTService = $chatGPTService;
    }

    public function generateResponse(Request $request)
    {
        $DisId = new GenUuid();
        $discussion = $DisId->genUuid();
        $ex = Discussion::firstOrCreate(['userId' => Auth::user()->userId],
            [
                "discussionId" => $discussion,
                "discussionTitle" => "default discussion",
                "userId" => Auth::user()->userId,
            ]
        );


        $userId = Auth::user()->userId;

        $data = $request->only(["prompt"]);
        $messageId = new GenUuid();
        $messageId2 = $messageId->genUuid();
        $messageId = $messageId->genUuid();

//        dd($ex->discussionId);

        $message1 = Message::create([
            "messageId" => $messageId,
            "messageContent" => $data["prompt"],
            "isBot" => false,
            "discussionId" => $ex->discussionId
        ]);

        $prompt = $data["prompt"];

        $response = $this->chatGPTService->getChatGPTResponse($prompt);


        $message2 = Message::create([
            "messageId" => $messageId2,
            "isBot" => true,
            "messageContent" => $response->original,
            "discussionId" => $ex->discussionId
        ]);

        return response()->json(["prompt"=>$message1, "reply"=>$message2], 200);
    }
}
