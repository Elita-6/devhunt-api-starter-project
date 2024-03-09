<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RessourceTag extends Model
{
    use HasFactory;

    protected $fillable = [
        "ressourceId",
        "tagId"
    ];
}
