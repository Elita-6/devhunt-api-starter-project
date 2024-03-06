<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ApartController extends BaseController
{
    
    public function exemple(Request $request){
        return response()->json(["data" => "Hello world"], 200);
    }

}
