<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', // センサー名
        'detail', // 機能
        'precision', // 精度
        'unit', // 単位
    ];
    
}
