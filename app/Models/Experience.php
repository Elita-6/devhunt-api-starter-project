<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        "experienceTitle",
        "experienceDescription",
        "dateStart",
        "dateEnd",
        "profileId",
    ];

    protected $primaryKey = "experienceId";

    protected $cast = [
        "created_at" => "datetime:Y-m-d H:m:i",
        "dateStart" => "datetime:Y-m-d H:m:i",
        "dateEnd" => "datetime:Y-m-d H:m:i",
    ];

    /**
     * Date format customized for serialization
     */
    public function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H-m-i');
    }

    /**
     * Get the profile that owns the Experience
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class, 'profileId');
    }

}
