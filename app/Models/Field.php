<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // ユーザーID
        'name', // 圃場名
        'key', // ラズベーパイID
    ];

    // センサー
    public function sensors() {
        return $this->hasMany(Sensor::class);
    }
    // 機器
    public function devices() {
        return $this->hasMany(Device::class);
    }
    // カメラ
    public function cameras() {
        return $this->hasMany(Camera::class);
    }
}
