<?php

namespace App\Http\Controllers;

use AdityaDees\LaravelBard\Exceptions\ErrorException;
use AdityaDees\LaravelBard\LaravelBard;
use Illuminate\Http\Request;


class BardController extends Controller
{
    //
    /**
     * @throws ErrorException
     */
    public function getResponseAi(Request $request){
        $prompt = $request->input('prompt');
        $bard = (new LaravelBard())->get_answer($prompt);
        $reply = $bard["content"];

        dd($reply);

    }
}
