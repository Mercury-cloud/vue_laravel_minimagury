<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogSensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'sensor_id', // センサーID
        'sensor_detail_id', // センサー詳細ID
        'value', // 測定値
        'unit', // 単位
        'note', // 注釈
    ];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
    public function sensor_detail()
    {
        return $this->belongsTo(SensorDetail::class);
    }
}
