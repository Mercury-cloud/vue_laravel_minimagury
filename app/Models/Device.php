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
        'timer', // タイマー使用するか
        'temperature', // エアコン用　温度
        'mode', // エアコン用　運転モード（冷房、暖房、除湿、AUTO、送風）
        'air_flow', // エアコン用　風量（弱、中、強、AUTO、パワフル）
        'wind_direction', // エアコン用　風量（上下、左右、AUTO）
        'status', // 現在の稼働状態　ON・OFF
        'schedule', // スケジュール
        'upper_limit', // アラート　上限値
        'upper_limit_inequality_sign', // アラート　上限等符号
        'upper_limit_alert_text', // アラート　上限こえたときの文言
        'lower_limit', // アラート　下限値
        'lower_limit_inequality_sign', // アラート　下限等符号
        'lower_limit_alert_text', // アラート　下限こえたときの文言
        'is_alert', // 現在のアラートの有無
        'alert_text', // 現在のアラート内容
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
