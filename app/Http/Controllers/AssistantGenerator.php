<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;

class AssistantGenerator extends Controller
{
    public function index(Request $request)
    {
        if ($request->title == null) {
            return response()->json(["message"=> "title = null"]);
        }

        try {
            $title = $request->title;
            $client = OpenAI::client(env('OPENAI_API_KEY'));

            $result = $client->completions()->create([
                "model" => "gpt-3.5-turbo",
                "temperature" => 0.7,
                "top_p" => 1,
                "frequency_penalty" => 0,
                "presence_penalty" => 0,
                'max_tokens' => 600,
                'prompt' => sprintf('Context: Web Developement \n %s', $title),
            ]);

            $content = trim($result['choices'][0]['text']);

            return response()->json(compact('title', 'content'));
        } catch (\Exception $th) {
            return response()->json(["messageError"=> $th->getMessage()]);
        }
    }
}
