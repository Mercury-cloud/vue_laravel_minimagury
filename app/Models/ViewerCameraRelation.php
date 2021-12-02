<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewerCameraRelation extends Model
{
    use HasFactory;

    protected $fillable = [
        'viewer_id', // ビューワーID
        'camera_id', // カメラID
    ];
}
