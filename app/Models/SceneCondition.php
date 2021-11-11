<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SceneCondition extends Model
{
    use HasFactory;

    protected $fillable = [
        'scene_id', // シーンID
        'type', // 数値、タイマー
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
