<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\GenUuid;

class UuidGeneratorControllor extends Controller
{
    public function generate(Request $request){
        $gen = new GenUuid();
        return response()->json($gen->genUuid());
    }
}
