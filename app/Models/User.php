<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'splash_file', // スプラッシュ画像
        'splash_color', // スプラッシュ背景カラーコード
        'theme_color', // テーマ色
        'background_color', // 背景色
        'push_permission', // push権限
        'push_alert', // アラートのpush
        'push_scene', // シーンのpush
        'push_camera_shot', // カメラ撮影時のpush
        'auth_code', // パスワード変更時認証コード
        'password',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 圃場
    public function fields() {
        return $this->hasMany(Field::class);
    }
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

    public function getSplashFilePathAttribute(){
        if ($this->image) {
            if (empty(config('aws.cloud_front.uri'))) {
                return asset("storage/".$this->splash_file);
            }
            return config('aws.cloud_front.uri')."/".$this->splash_file;
        } else {
            return null;
        }
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
