<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ressource extends Model
{
    use HasFactory;

    protected $fillable = [
        "ressourceId",
        "ressourceName",
        "ressourceUrl",
        "userId",
    ];


    protected $primaryKey = "ressourceId";
    protected $keyType = "string";

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


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    /**
     * The tags that belong to the Ressource
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'ressource_tags', 'ressourceId', 'tagId');
    }

}

