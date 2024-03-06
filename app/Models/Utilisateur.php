<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Utilisateur extends Authenticatable implements JWTSubject
{
    use HasFactory, HasApiTokens, Notifiable, HasUlids;

    protected $fillable = [
        "id",
        "username",
        "firstName",
        "lastName",
        "profileUrl",
        "typeProvider",
        "email",
        "password"
    ];

    protected $primaryKey = "id";

    protected $keyType = "string";


    protected $hidden = ["password"];

    protected $casts = [
        "password" => "hashed",
//         "created_at" => "datetime:Y-m-d H:m:i",
    ];


    public function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H-m-i');
    }

    /**
         * Get the identifier that will be stored in the JWT.
         *
         * @return mixed
         */
        public function getJWTIdentifier()
        {
            return $this->getKey();
        }

        /**
         * Return a key value array, containing any custom claims to be added to the JWT.
         *
         * @return array
         */
        public function getJWTCustomClaims()
        {
            return [];
        }

}
