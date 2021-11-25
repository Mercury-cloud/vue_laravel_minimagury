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
        'type', // センサータイプ
        'name', // センサー名
        'description', // 機能
        'aggregation_type', // 集計タイプ　3つ同時に集計まである
        'is_alert', // 現在のアラートの有無
        'alert_text', // 現在のアラート内容
        'alert_text2', // 現在のアラート内容2
        'alert_text3', // 現在のアラート内容3
        'latest_value_text', // 最新のログの項目名
        'latest_value', // 最新のログの値
        'latest_value2_text', // 最新のログの項目名2
        'latest_value2', // 最新のログの値2
        'latest_value3_text', // 最新のログの項目名3
        'latest_value3', // 最新のログの値3
    ];
}
