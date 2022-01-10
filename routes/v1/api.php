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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
// Route::post('login', [UserController::class, 'authenticate']);

// Route::group(['middleware' => ['jwt.verify']], function() {
Route::middleware('auth:api')->group(function(){
    Route::get('/user', [AuthController::class, 'getUser']);

    // 圃場
    Route::get('field/list', [FieldController::class, 'list']);
    Route::post('field/add', [FieldController::class, 'add']);
    Route::post('field/edit/{field}', [FieldController::class, 'edit']);
    Route::post('field/detail/{field}', [FieldController::class, 'detail']);
    Route::delete('field/delete/{field}', [FieldController::class, 'delete']);

    // センサー
    Route::get('sensor/{field}/list', [SensorController::class, 'list']);
    Route::post('sensor/{field}/add', [SensorController::class, 'add']);
    Route::get('sensor/detail/{sensor}', [SensorController::class, 'detail']);
    Route::delete('sensor/delete/{sensor}', [SensorController::class, 'delete']);
    Route::post('sensor/edit/{sensor}', [SensorController::class, 'edit']);
    Route::post('sensor-values-save/{id}', [SensorController::class, 'saveSensorValues']);
    Route::get('sensor-values-get/{id}', [SensorController::class, 'getSensorValues']);
    Route::post('sensor-detail-add', [SensorController::class, 'addSensorDetail']);
    Route::post('sensor-detail-edit/{id}', [SensorController::class, 'editSensorDetail']);
    Route::delete('sensor-detail-delete/{id}', [SensorController::class, 'deleteSensorDetail']);
    Route::get('sensor-get-by-field/{field_id}', [SensorController::class, 'getSensorByField']);

    // 機器
    Route::get('device/list', [DeviceController::class, 'list']);
    Route::post('device-add', [DeviceController::class, 'addDevice']);
    Route::post('device-info-edit/{id}', [DeviceController::class, 'editDeviceInfo']);
    Route::delete('device-info-delete/{id}', [DeviceController::class, 'deleteDeviceInfo']);
    Route::post('device-status-save/{id}', [DeviceController::class, 'saveDeviceStatus']);
    Route::get('device-status-get/{id}', [DeviceController::class, 'getDeviceStatus']);
    Route::post('device-temperature-save/{id}', [DeviceController::class, 'saveDeviceTemperature']);
    Route::get('device-temperature-get/{id}', [DeviceController::class, 'getDeviceTemperature']);
    Route::post('device-airflow-save/{id}', [DeviceController::class, 'saveDeviceAirflow']);
    Route::get('device-airflow-get/{id}', [DeviceController::class, 'getDeviceAirflow']);
    Route::post('device-wind-direction-save/{id}', [DeviceController::class, 'saveDeviceWindDirection']);
    Route::get('device-wind-direction-get/{id}', [DeviceController::class, 'getDeviceWindDirection']);
    Route::get('device-show/{id}', [DeviceController::class, 'showDevice']);


    // シーン
    Route::post('scene-add', [SceneController::class, 'addScene']);
    Route::get('scene-show/{id}', [SceneController::class, 'showScene']);
    Route::post('scene-info-edit/{id}', [SceneController::class, 'editSceneInfo']);
    Route::delete('scene-delete/{id}', [SceneController::class, 'deleteScene']);
    Route::get('scene-list', [SceneController::class, 'list']);
    Route::post('scene-condition-add', [SceneController::class, 'addSceneCondition']);
    Route::get('scene-condition-show/{id}', [SceneController::class, 'showSceneCondition']);
    Route::post('scene-condition-edit/{id}', [SceneController::class, 'editSceneCondition']);
    Route::delete('scene-condition-delete/{id}', [SceneController::class, 'deleteSceneCondition']);
    Route::get('scene-condition-list', [SceneController::class, 'listSceneCondition']);
    Route::get('sensor-show-by-scene/{scene_id}', [SceneController::class, 'showSensorByScene']);
    Route::get('scene-show-by-device/{device_id}', [SceneController::class, 'showSceneByDevice']);


    //カメラ
    Route::post('camera-add', [CameraController::class, 'addCamera']);
    Route::get('camera-list', [CameraController::class, 'listCameras']);
    Route::get('camera-get-by-field/{field_id}', [CameraController::class, 'getCameraByField']);
    Route::get('camera-record-data-get/{id}', [CameraController::class, 'getCameraRecordData']);
    Route::post('camera-type-save/{id}', [CameraController::class, 'saveCameraType']);
    Route::get('camera-detail-get/{id}', [CameraController::class, 'getCameraDetail']);
    Route::post('camera-for-timelapse-edit/{id}', [CameraController::class, 'editCameraForTimelapse']);
    Route::post('camera-edit/{id}', [CameraController::class, 'editCamera']);
    Route::delete('camera-delete/{id}', [CameraController::class, 'deleteCamera']);

    // タイムラプス
    Route::post('timelapse-add', [TimelapseController::class, 'addTimelapse']);
    Route::post('timelapse-info-edit/{id}', [TimelapseController::class, 'editTimelapseInfo']);
    Route::delete('timelapse-delete/{id}', [TimelapseController::class, 'deleteTimelapse']);
    Route::get('timelapse-get/{id}', [TimelapseController::class, 'getTimelapse']);
    Route::get('timelapse-url-get/{id}', [TimelapseController::class, 'getTimelapseUrl']);


    // 設定
    Route::get('/setting/get-list', [SettingController::class, 'settingGetList']);
    Route::get('/setting/splash', [SettingController::class, 'settingSplashGet']);
    Route::post('/setting/splash', [SettingController::class, 'settingSplashSet']);
    Route::post('/setting/user/password', [SettingController::class, 'settingUserPassword']);
    Route::post('/setting/user/name', [SettingController::class, 'settingUserName']);
    Route::post('/setting/user/email', [SettingController::class, 'settingUserEmail']);
    Route::post('/setting/user/color', [SettingController::class, 'settingUserColor']);
    Route::post('/setting/user/alert', [SettingController::class, 'settingUserAlert']);

    //viewer
    Route::post('viewer-add', [ViewerController::class, 'addViewer']);
    Route::post('viewer-info-edit/{id}', [ViewerController::class, 'editViewerInfo']);
    Route::delete('viewer-delete/{id}', [ViewerController::class, 'deleteViewer']);
    Route::get('viewer-list', [ViewerController::class, 'listViewer']);
    Route::get('get-main-view-data/{id}', [ViewerController::class, 'getMainViewData']);
    Route::get('get-log-detail/{id}', [ViewerController::class, 'getLogDetail']);
    Route::get('get-relations/{id}', [ViewerController::class, 'getRelations']);
    Route::post('edit-camera-relation/{id}', [ViewerController::class, 'editCameraRelation']);
    Route::post('edit-sensor-relation/{id}', [ViewerController::class, 'editSensorRelation']);
    Route::post('viewer/login', [ViewerController::class, 'viewerLogin']);
});

// middleware('auth:api')->
// 履歴
Route::name('log.')->group(function(){
    Route::get('action-log-list', [LogController::class, 'listActionLogs']);
    Route::get('camera-log-documentary-get/{camera_id}', [LogController::class, 'getCameraLog']);
    Route::post('log/camera/{camera_id}', [LogController::class, 'saveCameraLog']);
    Route::get('sensor-log-get/{sensor_id}/{sensor_detail_id}', [LogController::class, 'getSensorLog']);
    Route::post('log/sensor/{sensor_id}/{sensor_detail_id}/{slug}', [LogController::class, 'saveSensorLog'])->name('sensor');
});
