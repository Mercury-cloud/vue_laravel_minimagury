<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // ユーザーID
        'name', // 圃場名
        'device_id', // ラズベーパイID
    ];
}
