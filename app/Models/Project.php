<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'projectId',
        'title',
        'projectDescription',
        'imageUrl',
        'startDate',
        'endDate',
        'userId',
    ];

    protected $primaryKey = "projectId";
    protected $keyType = "string";

    protected $cast = [
        "created_at" => "datetime:Y-m-d H:m:i",
        "startDate" => "datetime:Y-m-d H:m:i",
        "endDate" => "datetime:Y-m-d H:m:i",
    ];

    /**
     * Date format customized for serialization
     */
    public function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H-m-i');
    }


    /**
     * Get the profile that owns the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class, 'profileId');
    }

    /**
     * Get all of the technologies for the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'tech_projects', 'projectId', 'technologyId');
    }
}
