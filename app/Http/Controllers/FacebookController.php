<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\FacebookService;

class FacebookController extends Controller
{
    //
    protected $facebookService;

    public function __construct(FacebookService $facebookService)
    {
        $this->facebookService = $facebookService;
    }

    public function publishPost()
    {
        $pageId = 'Mecasm.m';
        $message = 'Votre message ici';
        $response = $this->facebookService->postToPage($pageId, $message);

        // Gérer la réponse
        return response()->json($response);
    }
}
