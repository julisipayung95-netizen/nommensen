<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'users_id',
        'slug',
    ];

    /**
     * Relasi: Announcement ini dimiliki oleh (dibuat oleh) satu User.
     * belongsTo = "satu announcement milik satu user"
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
