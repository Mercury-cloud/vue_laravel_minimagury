<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Sensor;
use App\Models\SensorDetail;

class SensorController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_sensor(Request $request)
    {   
        $data = $request->only('name', 'type', 'field_id', 'user_id');
        $validator = Validator::make($data, [
            'name' => 'required|string|unique:sensors',
            'type' => 'required|string',
            'field_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $newSensor = Sensor::create([
            'name' => $request->name,
            'type' => $request->type,
            'field_id' => $request->field_id,
            'user_id' => $request->user_id
        ]);
        //Sensor created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Sensor "'.$request->name.'" is registered successfully',
            'data' => $newSensor
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified sensor in DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_sensor_info(Request $request, $id)
    {
        // Sensor update with request data
        $sensor = Sensor::find($id);
        if($sensor) {
            $sensor->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Sensor info is updated successfully!',
            ]);
        }
        else {
            // Respond error when sensor is not found
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found!',
            ], 500);            
        }
    }

    /**
     * Remove the specified sensor from DB.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_sensor_info(Request $request, $id)
    {
        // Sensor delete by id
        $sensor = Sensor::find($id);
        if($sensor) {
            $sensor->delete();
            return response()->json([
                'success' => true,
                'message' => 'Sensor info is deleted successfully!',
            ]);
        }
        else {
            // Respond error when sensor is not found
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found!',
            ], 500);            
        }
    }

    /**
     * Save Sensor Values.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save_sensor_values(Request $request, $id)
    {
        // Update sensor values
        $sensor = Sensor::find($id);
        if($sensor) {
            $sensor->latest_value = $request->latest_value;
            $sensor->latest_value2 = $request->latest_value2;
            $sensor->latest_value3 = $request->latest_value3;
            $sensor->save();
            return response()->json([
                'success' => true,
                'message' => 'Sensor info is updated successfully!',
            ]);
        }
        else {
            // Respond error when sensor is not found
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found!',
            ], 500);            
        }
    }

    /**
     * get Sensor Values.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_sensor_values($id)
    {
        // Get sensor value by id
        $sensor = Sensor::find($id);
        if($sensor) {
            return response()->json([
                'success' => true,
                'values' => [
                    'latest_value'=> $sensor->latest_value,
                    'latest_value2'=> $sensor->latest_value2,
                    'latest_value3'=> $sensor->latest_value3
                ]
            ]);
        }
        else {
            // Respond error when sensor is not found
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found!',
            ], 500);            
        }
    }


    /**
     * Display a listing of sensors.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_sensors()
    {
        // List all sensors
        $sensorlist = Sensor::get();
        if($sensorlist) {
            return response()->json([
                'success' => true,
                'data'=> $sensorlist
            ]);
        }
        else {
            // When sensor is not found
            return response()->json([
                'success' => true,
                'message' => 'There is no sensor!',
            ]);            
        }
    }

    /**
     * Store a newly created sensor detail in DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_sensor_detail(Request $request)
    {   
        $data = $request->only('name', 'type', 'sensor_id', 'precision', 'unit');
        $validator = Validator::make($data, [
            'sensor_id' => 'required|numeric',
            'type' => 'required|string',
            'name' => 'required|string',
            'precision' => 'required|numeric',
            'unit' => 'required|string'
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $newSensorDetail = SensorDetail::create([
            'sensor_id' => $request->sensor_id,
            'type' => $request->type,
            'name' => $request->name,
            'precision' => $request->precision,
            'unit' => $request->unit
        ]);
        //SensorDetail created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Sensor Detail "'.$request->name.'" is saved successfully',
            'data' => $newSensorDetail
        ], Response::HTTP_OK);
    }

    public function edit_sensor_detail(Request $request, $id)
    {
        // Sensor Detail update with request data
        $sensor_detail = SensorDetail::find($id);
        if($sensor_detail) {
            $sensor_detail->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Sensor detail is updated successfully!',
            ]);
        }
        else {
            // Respond error when sensor detail is not found
            return response()->json([
                'success' => false,
                'message' => 'Sensor detail not found!',
            ], 500);            
        }
    }

    public function delete_sensor_detail(Request $request, $id)
    {
        // Sensor Detail delete by id
        $sensor_detail = SensorDetail::find($id);
        if($sensor_detail) {
            $sensor_detail->delete();
            return response()->json([
                'success' => true,
                'message' => 'Sensor detail is deleted successfully!',
            ]);
        }
        else {
            // Respond error when sensor detail is not found
            return response()->json([
                'success' => false,
                'message' => 'Sensor detail not found!',
            ], 500);            
        }
    }

    /**
     * Get the sensor by field Id.
     *
     * @param  int  $field_id
     * @return \Illuminate\Http\Response
     */
    public function get_sensor_by_field($field_id)
    {
        // Get Sensor by field id
        $sensors = Sensor::where('field_id', '=', $field_id)->get();
        if(count($sensors)) {
            return response()->json([
                'success' => true,
                'sensors'=> $sensors
            ]);
        }
        else {
            // Respond error when sensor is not found
            return response()->json([
                'success' => false,
                'message' => 'sensor not found!',
            ], 500);            
        }
    }

    
}
