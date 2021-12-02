<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id', // 機器ID
        'type', // 操作タイプ　手動かシーンか
        'target', // 操作対象
        'description', // 操作内容詳細
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
