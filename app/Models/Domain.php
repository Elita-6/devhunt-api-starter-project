<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        "domainName"
    ];


    protected $primaryKey = "domainId";

    protected $cast = [
        "created_at" => "datetime:Y-m-d H:m:i",
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
     * The profiles that belong to the Domain
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(UserProfile::class, 'profile_domains', 'user_id', 'profileId');
    }

}
