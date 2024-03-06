<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileTech extends Model
{
    use HasFactory;

    protected $fillable = [
        "profileId",
        "technologyId",
    ];
}
