<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'namalengkap',
        'namapanggilan',
        'email',
        'nomor_hp',
        'jalur',
        'image',
        'programstudi_1',
        'programstudi_2',
    ];
}
