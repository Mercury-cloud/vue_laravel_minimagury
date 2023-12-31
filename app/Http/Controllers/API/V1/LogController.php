<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Log\CameraLogRequest;
use App\Http\Requests\API\V1\Log\SensorLogRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\LogAction;
use App\Models\LogSensor;
use App\Models\LogCameraDocumentary;
use App\Models\Camera;
use App\Models\Sensor;
use App\Models\SensorDetail;

class LogController extends Controller
{
    public function listActionLogs()
    {
        // List all action logs
        $actionlist = LogAction::get();
        if($actionlist) {
            return response()->json([
                'success' => true,
                'data'=> $actionlist
            ]);
        }
        else {
            // When action is not found
            return response()->json([
                'success' => true,
                'message' => 'There is no action log!',
            ]);            
        }
    }

    public function getCameraLog($camera_id)
    {
        // List all camera log documentaries
        $cameraloglist = LogCameraDocumentary::where("camera_id", "=", $camera_id)->get();
        if($cameraloglist) {
            return response()->json([
                'success' => true,
                'data'=> $cameraloglist
            ]);
        }
        else {
            // When camera log is not found
            return response()->json([
                'success' => true,
                'message' => 'There is no camera log!',
            ]);            
        }
    }

    public function saveCameraLog(CameraLogRequest $request, $camera_id)
    {
        $newLogCamera = LogCameraDocumentary::create([
            'camera_id' => $camera_id,
            'file' => $request->file,
            'date' => $request->date
        ]);

        $camera = Camera::find($camera_id);
        $camera->file = intval($request->file);
        $camera->save();

        //Sensor log created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Camera log is created successfully',
            'log_data' => $newLogCamera
        ], Response::HTTP_OK);
    }

    public function getSensorLog($sensor_id, $sensor_detail_id)
    {
        // List all sensor log
        $sensorloglist = LogSensor::where("sensor_id", "=", $sensor_id)->where("sensor_detail_id", "=", $sensor_detail_id)->get();
        if($sensorloglist) {
            return response()->json([
                'success' => true,
                'data'=> $sensorloglist
            ]);
        }
        else {
            // When sensor log is not found
            return response()->json([
                'success' => true,
                'message' => 'There is no sensor log!',
            ]);            
        }
    }

    public function saveSensorLog(SensorLogRequest $request, $sensor_detail_id, $sensor_id, $slug )
    {
        $newLogSensor = LogSensor::create([
            'sensor_id' => $sensor_id,
            'sensor_detail_id' => $sensor_detail_id,
            'value' => $request->value,
            'unit' => $request->unit,
        ]);

        $sensor = Sensor::where('id','=',$sensor_id)->first();
        $sensor_detail = SensorDetail::where('id','=',$sensor_detail_id)->where('slug','=',$slug)->first();
        
        if($sensor_detail->unit != $request->unit) {
            return response()->json([
                'success' => true,
                'message' => 'Unit is not equal, can not define if alert is enable!',
                'log_data' => $newLogSensor
            ], Response::HTTP_OK);
        }

        if($sensor_detail->lower_limit > $request->value || $sensor_detail->upper_limit < $request->value) {
            $sensor->is_alert = true;
            $sensor->alert_text = $sensor_detail->alert_text;
            $sensor->save();
        }

        //Sensor log created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Sensor log is created successfully',
            'log_data' => $newLogSensor
        ], Response::HTTP_OK);
    }

    
}
