<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        "messageContent",
        "isBot",
        "discussionId",
    ];


    protected $primaryKey = "messageId";

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
     * Get the discussion that owns the Message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discussion(): BelongsTo
    {
        return $this->belongsTo(Discussion::class, 'discussionId');
    }
}
