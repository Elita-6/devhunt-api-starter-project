<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcourDeboucher extends Model
{
    use HasFactory;

    protected $fillable = [
        "parcourId",
        "deboucherId"
    ];
}
