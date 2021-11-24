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
        'aggregation_type', // 集計タイプ　3つ同時に集計まである
        'upper_limit', // アラート　上限値
        'upper_limit_inequality_sign', // アラート　上限等符号
        'upper_limit_alert_text', // アラート　上限こえたときの文言
        'lower_limit', // アラート　下限値
        'lower_limit_inequality_sign', // アラート　下限等符号
        'lower_limit_alert_text', // アラート　下限こえたときの文言
        'is_alert', // 現在のアラートの有無
        'alert_text', // 現在のアラート内容
        'latest_value', // 最新のログの値
        'latest_value2', // 最新のログの値2
        'latest_value3', // 最新のログの値3
    ];
}
