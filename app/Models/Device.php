<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // ユーザーID
        'field_id', // 圃場ID
        'name', // 機器名
        'icon', // アイコン
        'description', // 使用目的
        'type', // 機器のタイプ
        'temperature', // エアコン用　温度
        'mode', // エアコン用　運転モード（冷房、暖房、除湿、AUTO、送風）
        'air_flow', // エアコン用　風量（弱、中、強、AUTO、パワフル）
        'wind_direction', // エアコン用　風量（上下、左右、AUTO）
        'status', // 現在の稼働状態
        'schedule', // スケジュール
        'alert', // アラートの有無
        'alert_text', // アラート内容
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
