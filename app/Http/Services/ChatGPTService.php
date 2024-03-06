<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
class ChatGPTService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function generateResponse($prompt)
    {
        $response = $this->client->post('engines/davinci-codex/completions', [
            'json' => [
                'prompt' => $prompt,
                'max_tokens' => 60,
                'temperature' => 0.7,
            ],
        ]);

        $body = json_decode($response->getBody(), true);
        return $body['choices'][0]['text'];
    }
}
