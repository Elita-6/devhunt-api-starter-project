<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
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
               "message" => [
                "role" => "user",
               "content" => $message
            ],
               "temperature" => 0,
               "max_tokens" => 2048
           ]
        )->body();

        return $response()->json(json_decode($response));
    }
}
