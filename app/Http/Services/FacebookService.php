<?php

namespace App\Http\Services;

use Facebook\Facebook;

class FacebookService
{
    protected $fb;

    public function __construct()
    {
        $this->fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v13.0',
        ]);
    }

    public function getUserProfile($accessToken)
    {
        try {
            $response = $this->fb->get('/me?fields=id,name,email', $accessToken);
            return $response->getGraphUser();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    }

    public function postToPage($pageId, $message)
    {
        try {
            $response = $this->fb->post("/{$pageId}/feed", ['message' => $message], 'EAA...'); // Utilisez votre token de page ici
            return $response->getGraphNode()->asArray();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
    }
}
