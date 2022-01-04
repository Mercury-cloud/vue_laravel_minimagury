<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\API\V1\BaseController;
use App\Http\Controllers\API\V1\DeviceController;
use App\Http\Controllers\API\V1\FieldController;
use App\Http\Controllers\API\V1\SceneController;
use App\Http\Controllers\API\V1\SensorController;
use App\Http\Controllers\API\V1\CameraController;
use App\Http\Controllers\API\V1\TimelapseController;
use App\Http\Controllers\API\V1\LogController;
use App\Http\Controllers\API\V1\SettingController;
use App\Http\Controllers\API\V1\ViewerController;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\ApiController;
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

Route::post('login', [UserController::class, 'authenticate']);

// Route::group(['middleware' => ['jwt.verify']], function() {
Route::middleware('auth:api')->group(function(){
    Route::get('/user', [UserController::class, 'get_user']);

    // 圃場
    Route::get('field/list', [FieldController::class, 'list']);
    Route::post('field/add', [FieldController::class, 'add']);
    Route::post('field/edit/{field}', [FieldController::class, 'edit']);
    Route::post('field/detail/{field}', [FieldController::class, 'detail']);
    Route::delete('field/delete/{field}', [FieldController::class, 'delete']);

    // センサー
    Route::post('sensor-add', [SensorController::class, 'add_sensor']);
    Route::post('sensor-info-edit/{id}', [SensorController::class, 'edit_sensor_info']);
    Route::delete('sensor-info-delete/{id}', [SensorController::class, 'delete_sensor_info']);
    Route::post('sensor-values-save/{id}', [SensorController::class, 'save_sensor_values']);
    Route::get('sensor-values-get/{id}', [SensorController::class, 'get_sensor_values']);
    Route::get('sensor-list', [SensorController::class, 'list_sensors']);
    Route::post('sensor-detail-add', [SensorController::class, 'add_sensor_detail']);
    Route::post('sensor-detail-edit/{id}', [SensorController::class, 'edit_sensor_detail']);
    Route::delete('sensor-detail-delete/{id}', [SensorController::class, 'delete_sensor_detail']);
    Route::get('sensor-get-by-field/{field_id}', [SensorController::class, 'get_sensor_by_field']);

    // 機器
    // Route::apiResource('device', DeviceController::class);
    Route::post('device-add', [DeviceController::class, 'add_device']);
    Route::post('device-info-edit/{id}', [DeviceController::class, 'edit_device_info']);
    Route::delete('device-info-delete/{id}', [DeviceController::class, 'delete_device_info']);
    Route::post('device-status-save/{id}', [DeviceController::class, 'save_device_status']);
    Route::get('device-status-get/{id}', [DeviceController::class, 'get_device_status']);
    Route::post('device-temperature-save/{id}', [DeviceController::class, 'save_device_temperature']);
    Route::get('device-temperature-get/{id}', [DeviceController::class, 'get_device_temperature']);
    Route::post('device-airflow-save/{id}', [DeviceController::class, 'save_device_airflow']);
    Route::get('device-airflow-get/{id}', [DeviceController::class, 'get_device_airflow']);
    Route::post('device-wind-direction-save/{id}', [DeviceController::class, 'save_device_wind_direction']);
    Route::get('device-wind-direction-get/{id}', [DeviceController::class, 'get_device_wind_direction']);
    Route::get('device-show/{id}', [DeviceController::class, 'show_device']);
    Route::get('device-list', [DeviceController::class, 'list_device']);


    // シーン
    Route::post('scene-add', [SceneController::class, 'add_scene']);
    Route::get('scene-show/{id}', [SceneController::class, 'show_scene']);
    Route::post('scene-info-edit/{id}', [SceneController::class, 'edit_scene_info']);
    Route::delete('scene-delete/{id}', [SceneController::class, 'delete_scene']);
    Route::get('scene-list', [SceneController::class, 'list_scene']);
    Route::post('scene-condition-add', [SceneController::class, 'add_scene_condition']);
    Route::get('scene-condition-show/{id}', [SceneController::class, 'show_scene_condition']);
    Route::post('scene-condition-edit/{id}', [SceneController::class, 'edit_scene_condition']);
    Route::delete('scene-condition-delete/{id}', [SceneController::class, 'delete_scene_condition']);
    Route::get('scene-condition-list', [SceneController::class, 'list_scene_condition']);
    Route::get('sensor-show-by-scene/{scene_id}', [SceneController::class, 'show_sensor_by_scene']);
    Route::get('scene-show-by-device/{device_id}', [SceneController::class, 'show_scene_by_device']);


    //カメラ
    Route::post('camera-add', [CameraController::class, 'add_camera']);
    Route::get('camera-list', [CameraController::class, 'list_cameras']);
    Route::get('camera-get-by-field/{field_id}', [CameraController::class, 'get_camera_by_field']);
    Route::get('camera-record-data-get/{id}', [CameraController::class, 'get_camera_record_data']);
    Route::post('camera-type-save/{id}', [CameraController::class, 'save_camera_type']);
    Route::get('camera-detail-get/{id}', [CameraController::class, 'get_camera_detail']);
    Route::post('camera-for-timelapse-edit/{id}', [CameraController::class, 'edit_camera_for_timelapse']);
    Route::post('camera-edit/{id}', [CameraController::class, 'edit_camera']);
    Route::delete('camera-delete/{id}', [CameraController::class, 'delete_camera']);

    // タイムラプス
    Route::post('timelapse-add', [TimelapseController::class, 'add_timelapse']);
    Route::post('timelapse-info-edit/{id}', [TimelapseController::class, 'edit_timelapse_info']);
    Route::delete('timelapse-delete/{id}', [TimelapseController::class, 'delete_timelapse']);
    Route::get('timelapse-get/{id}', [TimelapseController::class, 'get_timelapse']);
    Route::get('timelapse-url-get/{id}', [TimelapseController::class, 'get_timelapse_url']);

    // 履歴
    Route::get('action-log-list', [LogController::class, 'list_action_logs']);
    Route::get('camera-log-documentary-get/{camera_id}', [LogController::class, 'get_camera_log']);
    Route::post('log/camera/{camera_id}', [LogController::class, 'save_camera_log']);
    Route::get('sensor-log-get/{sensor_id}/{sensor_detail_id}', [LogController::class, 'get_sensor_log']);
    Route::post('log/sensor/{sensor_id}/{sensor_detail_id}', [LogController::class, 'save_sensor_log']);

    // 設定
    Route::get('/setting/get-list', [SettingController::class, 'settingGetList']);
    Route::get('/setting/splash', [SettingController::class, 'settingSplashGet']);
    Route::post('/setting/splash', [SettingController::class, 'settingSplashSet']);
    Route::post('/setting/user/password', [SettingController::class, 'settingUserPassword']);
    Route::post('/setting/user/name', [SettingController::class, 'settingUserName']);
    Route::post('/setting/user/email', [SettingController::class, 'settingUserEmail']);

    //viewer
    Route::post('viewer-add', [ViewerController::class, 'add_viewer']);
    Route::post('viewer-info-edit/{id}', [ViewerController::class, 'edit_viewer_info']);
    Route::delete('viewer-delete/{id}', [ViewerController::class, 'delete_viewer']);
    Route::get('viewer-list', [ViewerController::class, 'list_viewer']);
    Route::get('get-main-view-data/{id}', [ViewerController::class, 'get_main_view_data']);
    Route::get('get-log-detail/{id}', [ViewerController::class, 'get_log_detail']);
    Route::get('get-relations/{id}', [ViewerController::class, 'get_relations']);
    Route::post('edit-camera-relation/{id}', [ViewerController::class, 'edit_camera_relation']);
    Route::post('edit-sensor-relation/{id}', [ViewerController::class, 'edit_sensor_relation']);
    Route::post('viewer/login', [ViewerController::class, 'viewer_login']);
});
