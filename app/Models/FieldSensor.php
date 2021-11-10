<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldSensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'sensor_id', // センサーID
        'user_id', // ユーザーID
        'field_id', // 圃場ID
        'name', // センサー名
    ];
}
