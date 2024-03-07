<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use http\Env\Response;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Http;
use OpenAI\Laravel\Facades\OpenAI;

class ChatGPTService
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getChatGPTClient()
    {
        return new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function getChatGPTResponse($message)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPEN_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post("https://api.openai.com/v1/chat/completions",
            [
                "model" => "gpt-3.5-turbo",
                "messages" => [
                    [
                        "role" => "user",
                        "content" => $message
                    ]
                ],
                "temperature" => 0,
                "max_tokens" => 2048
            ]
        )->body();

        $responseArray = json_decode($response, true);

// Vérifier si la réponse contient des choix
        if (isset($responseArray['choices']) && count($responseArray['choices']) > 0) {
            // Récupérer le contenu de la première réponse
            $responseContent = $responseArray['choices'][0]['message']['content'];
            return response()->json($responseContent);
        } else {
            return response()->json(["error"=> "Aucune réponse n'a été générée."]);
        }


    }
}
