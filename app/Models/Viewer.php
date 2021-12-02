<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viewer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // ユーザーID
        'is_valid', // 有効かどうか
        'login_id', // ログインID（招待ID）
        'password_text', // パスワード共有用
        'expiration_date', // 有効期限
        'password', // パスワード
        'api_token',
    ];

    protected $hidden = [
        'password',
    ];


    public function cameras()
    {
        return $this->hasManyThrough(
            Camera::class,
            ViewerCameraRelation::class,
            'viewer_id',
            'id',
            null,
            'camera_id',
        );
    }
    
    public function sensors()
    {
        return $this->hasManyThrough(
            Sensor::class,
            ViewerSensorRelation::class,
            'viewer_id',
            'id',
            null,
            'sensor_id',
        );
    }
}
