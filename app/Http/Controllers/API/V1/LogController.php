<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function list_action_logs(Request $request)
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

    public function get_camera_log(Request $request, $camera_id)
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

    public function save_camera_log(Request $request, $camera_id)
    {
        $data = $request->only('camera_id', 'file', 'date');
       
        $validator = Validator::make($data, [
            'camera_id' => 'required|numeric',
            'file' => 'required|string',
            'date' => 'required|date_format:Y-m-d'
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

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

    public function get_sensor_log(Request $request, $sensor_id, $sensor_detail_id)
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

    public function save_sensor_log(Request $request, $sensor_id, $sensor_detail_id)
    {
        $data = $request->only('value', 'unit');
       
        $validator = Validator::make($data, [
            'value' => 'required|numeric',
            'unit' => 'required|string'
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $newLogSensor = LogSensor::create([
            'sensor_id' => $sensor_id,
            'sensor_detail_id' => $sensor_detail_id,
            'value' => $request->value,
            'unit' => $request->unit,
        ]);

        $sensor = Sensor::find($sensor_id);
        $sensorDetail = SensorDetail::find($sensor_detail_id);

        if($sensorDetail->unit != $request->unit) {
            return response()->json([
                'success' => true,
                'message' => 'Unit is not equal, can not define if alert is enable!',
                'log_data' => $newLogSensor
            ], Response::HTTP_OK);
        }
        if($sensorDetail->lower_limit > $request->value || $sensorDetail->upper_limit < $request->value) {
            $sensor->is_alert = true;
            $sensor->alert_text = $sensorDetail->alert_text;
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
