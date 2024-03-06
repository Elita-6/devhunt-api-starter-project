<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key and Organization
    |--------------------------------------------------------------------------
    |
    | Here you may specify your OpenAI API Key and organization. This will be
    | used to authenticate with the OpenAI API - you can find your API key
    | and organization on your OpenAI dashboard, at https://openai.com.
    */

    'api_key' => env('OPENAI_API_KEY'),
    'organization' => env('OPENAI_ORGANIZATION'),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | The timeout may be used to specify the maximum number of seconds to wait
    | for a response. By default, the client will time out after 30 seconds.
    */

    'request_timeout' => env('OPENAI_REQUEST_TIMEOUT', 30),
];


// use OpenAI\Client;

// $openai = new Client([
//     'api_key' => env('OPENAI_API_KEY'),
// ]);

// $response = $openai->chatCompletion([
//     'model' => 'gpt-3.5-turbo',
//     'messages' => [
//         ['role' => 'system', 'content' => 'You are a helpful assistant.'],
//         ['role' => 'user', 'content' => 'Who won the world series in 2020?'],
//     ],
// ]);
