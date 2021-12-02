<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', // ユーザーID
        'field_id', // 圃場ID
        'name', // カメラ名
        'is_360_degree', // 360度カメラかどうか
        'for_timelapse', // タイムラプス用かどうか
        'shooting_span', // タイムラプス用　撮影スパン
        'file', // 直近の録画データ
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
