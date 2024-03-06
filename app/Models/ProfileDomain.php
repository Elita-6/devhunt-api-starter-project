<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileDomain extends Model
{
    use HasFactory;

    protected $fillable = [
        "profileId",
        "domainId"
    ];
}
