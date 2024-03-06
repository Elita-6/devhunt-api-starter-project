<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Porte extends Model
{
    use HasFactory;

    protected $fillable = [
        "porteId",
        "profileId",
    ];

    protected $primaryKey = "porteId";

    protected $cast = [
        "created_at" => "datetime:Y-m-d H:m:i",
    ];

    /**
     * Date format customized for serialization
     */
    public function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H-m-i');
    }

    /**
     * Get all of the profile for the Porte
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profile(): HasMany
    {
        return $this->hasMany(UserProfile::class);
    }

}
