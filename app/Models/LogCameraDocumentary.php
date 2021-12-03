<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogCameraDocumentary extends Model
{
    use HasFactory;
    protected $fillable = [
        'camera_id', // カメラID
        'file', // データファイル保存先
        'date', // 撮影日
    ];

    protected $dates = [
        'date',
    ];

    protected $appends = [
        'file_path',
    ];

    public function camera()
    {
        return $this->belongsTo(Camera::class);
    }

    public function getFilePathAttribute() {
        if ($this->file) {
            assert(!empty(config('aws.cloud_front.uri')));
            return config('aws.cloud_front.uri')."/".$this->file;
        } else {
            return null;
        }
    }
}
