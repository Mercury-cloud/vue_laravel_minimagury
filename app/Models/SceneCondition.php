<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SceneCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'scene_id', // シーンID
        'sensor_id', // センサーID
        'sensor_detail_id', // センサー詳細ID
        'type', // 数値、タイマー
        'name', // 条件名（温度、湿度等）
        'aggregation_type', // 数値の集計タイプ　3つ同時に集計まである
        'threshold', // 閾値
        'wind_direction', // 以上・以下
        'start_time', // 開始時間
        'end_time', // 終了時間
        'monday', // 実行曜日　月
        'tuesday', // 実行曜日　火
        'wednesday', // 実行曜日　水
        'thursday', // 実行曜日　木
        'friday', // 実行曜日　金
        'saturday', // 実行曜日　土
        'sunday', // 実行曜日　日
    ];

    
}
