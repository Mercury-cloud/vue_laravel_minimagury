<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewerSensorRelation extends Model
{
    use HasFactory;

    protected $fillable = [
        'viewer_id', // ビューワーID
        'sensor_id', // センサーID
    ];
}
