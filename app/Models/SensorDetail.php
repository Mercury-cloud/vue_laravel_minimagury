<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'sensor_id', // センサーID
        'type', // センサータイプ
        'name', // センサー名
        'description', // 機能
        'precision', // 精度
        'precision_type', // 精度種類 ['float', 'int']
        'unit', // 単位
        'measuring_range_upper_limit', // 測定範囲　上限値
        'measuring_range_lower_limit', // 測定範囲　下限値
        'lower_limit', // アラート　下限値
        'lower_limit_inequality_sign', // アラート　下限等符号
        'lower_limit_alert_text', // アラート　下限こえたときの文言
        'upper_limit', // アラート　上限値
        'upper_limit_inequality_sign', // アラート　上限等符号
        'upper_limit_alert_text', // アラート　上限こえたときの文言
        'is_alert', // 現在のアラートの有無
        'alert_text', // 現在のアラート内容
    ];


    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}
