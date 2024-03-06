<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Deboucher extends Model
{
    use HasFactory;

    protected $fillable = [
        "deboucherName",
    ];

    protected $primaryKey = "deboucherId";

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
     * The parcours that belong to the Deboucher
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function parcours(): BelongsToMany
    {
        return $this->belongsToMany(Parcour::class, 'parcour_debouchers', 'deboucherId', 'parcourId');
    }

}
