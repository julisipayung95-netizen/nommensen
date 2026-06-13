<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aboutme extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'image',
    ];

    use HasFactory;
    protected $casts = [
        'image' => 'array',
    ];
}
