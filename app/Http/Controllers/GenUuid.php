<?php
namespace App\Http\Controllers;

use Illuminate\Support\Str;

class GenUuid {
    public function genUuid(){
        return Str::uuid();
    }
}
