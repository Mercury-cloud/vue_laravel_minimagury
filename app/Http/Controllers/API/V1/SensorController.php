<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Field;
use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Sensor\AddRequest;
use App\Http\Requests\API\V1\Sensor\EditRequest;
use App\Http\Requests\API\V1\Sensor\SensorValueRequest;
use App\Http\Requests\API\V1\Sensor\SensorDetailAddRequest;
use App\Http\Requests\API\V1\Sensor\SensorDetailEditRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Sensor;
use App\Models\SensorDetail;

class SensorController extends Controller
{
    /**
     * Display a listing of sensors.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request, Field $field)
    {
        // List all sensors
        $sensorlist = Sensor::where('field_id', $field->id)->get();
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
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\V1\Sensor\AddRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function add(AddRequest $request, Field $field)
    {   

        $newSensor = Sensor::firstOrCreate([
            'name' => $request->name,
            'type' => $request->type,
            'field_id' => $field->id,
            'user_id' => auth()->user()->id,
        ]);

        // センサーに紐づく集計情報保存
        $sensor_details = config('params.sensor_details')[$request->type];
        foreach ($sensor_details as $sensor_detail) {
            SensorDetail::create(['sensor_id' => $newSensor->id, 'slug' => Str::uuid()] + $sensor_detail);
        }
        $newSensor->refresh();
        $newSensor->load('details');

        //Sensor created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Sensor "'.$request->name.'" is registered successfully',
            'data' => $newSensor,
        ], Response::HTTP_OK);
    }

    // 詳細
    public function detail(Sensor $sensor)
    {
        $sensor->load('details');
        return response()->json([
            'success' => true,
            'data' => $sensor,
        ]);
    }

    /**
     * Remove the specified sensor from DB.
     *
     * @param  Sensor $sensor
     * @return \Illuminate\Http\Response
     */
    public function delete(Sensor $sensor)
    {
        $sensor->delete();
        return response()->json([
            'success' => true,
            'message' => 'Sensor info is deleted successfully!',
        ]);
    }

    /**
     * Update the specified sensor in DB.
     *
     * @param  App\Http\Requests\API\V1\Sensor\EditRequest  $request
     * @param  Sensor $sensor
     * @return \Illuminate\Http\Response
     */
    public function edit(EditRequest $request, Sensor $sensor)
    {
        $sensor->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Sensor info is updated successfully!',
            'data' => $sensor,
        ]);
    }


    /**
     * Save Sensor Values.
     *
     * @param  App\Http\Requests\API\V1\Sensor\SensorValueRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveSensorValues(SensorValueRequest $request, $id)
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
    public function getSensorValues($id)
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
     * Store a newly created sensor detail in DB.
     *
     * @param  App\Http\Requests\API\V1\Sensor\SensorDetailAddRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function addSensorDetail(SensorDetailAddRequest $request)
    {   
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

    public function editSensorDetail(SensorDetailEditRequest $request, $id)
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

    public function deleteSensorDetail($id)
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
    public function getSensorByField($field_id)
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
