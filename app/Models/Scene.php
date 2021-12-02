<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id', // 機器ID
        'name', // シーン名
        'detail', // 詳細
        'power', // 電源
        'temperature', // エアコン用　温度
        'mode', // エアコン用　運転モード（冷房、暖房、除湿、AUTO、送風）
        'air_flow', // エアコン用　風量（弱、中、強、AUTO、パワフル）
        'wind_direction', // エアコン用　風向（上下、左右、AUTO）
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    
}
