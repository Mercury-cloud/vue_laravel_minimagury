<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timelapse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // 
        'interval', // 
        'setting', // 
        'share_url',
    ];
}
