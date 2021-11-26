<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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
}
