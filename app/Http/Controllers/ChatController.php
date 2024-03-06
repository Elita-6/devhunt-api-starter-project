<?php

namespace App\Http\Controllers;

use App\Http\Services\ChatGPTService;
use Illuminate\Http\Request;

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
        $prompt = $request->input('prompt');
        $response = $this->chatGPTService->generateResponse($prompt);

        return response()->json(['response' => $response]);
    }
}
