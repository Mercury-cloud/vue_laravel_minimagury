<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\BaseController;
use App\Http\Controllers\API\V1\DeviceController;
use App\Http\Controllers\API\V1\FieldController;
use App\Http\Controllers\API\V1\SceneController;
use App\Http\Controllers\API\V1\SensorController;
use App\Http\Controllers\API\V1\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function(){
    // Route::get('/user', [BaseController::class, 'user']);

    // 圃場
    Route::apiResource('field', FieldController::class);


    // センサー
    Route::apiResource('sensor', SensorController::class);


    // 機器
    Route::apiResource('device', DeviceController::class);


    // シーン
    Route::apiResource('scene', SceneController::class);

    // 設定
    Route::get('/setting/splash', [SettingController::class, 'settingSplash']);
    Route::post('/setting/splash', [SettingController::class, 'settingSplash']);
    Route::post('/setting/user/password', [SettingController::class, 'settingUserPassword']);
    Route::post('/setting/user/name', [SettingController::class, 'settingUserName']);
    Route::post('/setting/user/email', [SettingController::class, 'settingUserEmail']);
});
