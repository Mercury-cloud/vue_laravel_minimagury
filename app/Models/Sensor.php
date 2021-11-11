<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', // ユーザーID
        'field_id', // 圃場ID
        'name', // センサー名
        'description', // 機能
        'precision', // 精度
        'precision_type', // 精度種類
        'unit', // 単位
        'latest_value', // 最新のログの値
    ];
    
}
