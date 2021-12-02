<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogCameraDocumentary extends Model
{
    use HasFactory;
    protected $fillable = [
        'camera_id', // 
        'file', // 
        'date', // 
    ];

    protected $dates = [
        'date',
    ];

    protected $appends = [
        'file_path',
    ];

    public function getFilePathAttribute() {
        if ($this->file) {
            assert(!empty(config('aws.cloud_front.uri')));
            return config('aws.cloud_front.uri')."/".$this->file;
        } else {
            return null;
        }
    }
}
