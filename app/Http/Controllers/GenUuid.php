<?php
namespace App\Http\Controllers;

use Illuminate\Support\Str;

class GenUuid {
    public function genUuid(){
        $ids = [];
        for ($i = 0; $i < 10; $i++){
            array_push($ids, Str::uuid());
        }
        return $ids;
    }
}
