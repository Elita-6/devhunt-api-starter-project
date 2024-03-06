<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parcour extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "parcourDesign",
        "parcourDescritpion"
    ];

    protected $primaryKey = "parcourId";

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
     * Get all of the profiles for the Parcour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profiles(): HasMany
    {
        return $this->hasMany(UserProfile::class);
    }

    /**
     * The debouchers that belong to the Parcour
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function debouchers(): BelongsToMany
    {
        return $this->belongsToMany(Deboucher::class, 'parcour_debouchers', 'parcourId', 'deboucherId');
    }

}
