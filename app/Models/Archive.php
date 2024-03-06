<?php

namespace App\Models;


use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        "archiveDate",
    ];


    protected $primaryKey = "archiveId";

    protected $cast = [
        "created_at" => "datetime:Y-m-d H:m:i",
        "archiveDate" => "datetime:Y-m-d H:m:i",
    ];

    /**
     * Date format customized for serialization
     */
    public function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H-m-i');
    }

    /**
     * Get the post associated with the Archive
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
