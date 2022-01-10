<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Device\AddRequest;
use App\Http\Requests\API\V1\Device\EditRequest;
use App\Http\Requests\API\V1\Device\StatusRequest;
use App\Http\Requests\API\V1\Device\TemperatureRequest;
use App\Http\Requests\API\V1\Device\AirflowRequest;
use App\Http\Requests\API\V1\Device\WindDirectionRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;

class DeviceController extends Controller
{

   
    /**
     * Store a newly created device into the DB.
     *
     * @param  App\Http\Requests\API\V1\Device\AddRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function addDevice(AddRequest $request)
    {   
        $newDevice = Device::create([
            'name' => $request->name,
            'type' => $request->type,
            'user_id' => $request->user_id,
            'field_id' => $request->field_id,
        ]);
        //Device created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Device created successfully',
            'data' => $newDevice,
        ], Response::HTTP_OK);
    }
    
    /**
     * Update the device.
     *
     * @param  App\Http\Requests\API\V1\Device\EditRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editDeviceInfo(EditRequest $request, $id)
    {
        // Device update with request data
        $device = Device::find($id);
        if($device) {
            $device->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Device info is updated successfully!',
            ]);
        }
        else {
            // Respond error when device is not found
            return response()->json([
                'success' => false,
                'message' => 'Device not found!',
            ], 500);            
        }
    }

    /**
     * Remove the device.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteDeviceInfo($id)
    {
        // Device delete by id
        $device = Device::find($id);
        if($device) {
            $device->delete();
            return response()->json([
                'success' => true,
                'message' => 'Device is deleted successfully!',
            ]);
        }
        else {
            // Respond error when device is not found
            return response()->json([
                'success' => false,
                'message' => 'Device not found!',
            ], 500);            
        }
    }

    /**
     * save the device status.
     *
     * @param  App\Http\Requests\API\V1\Device\StatusRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveDeviceStatus(StatusRequest $request, $id)
    {

        // Update device status by id
        $device = Device::find($id);
        if($device) {
            $device->status = $request->status;
            $device->save();
            return response()->json([
                'success' => true,
                'message' => 'Device status is updated successfully!',
            ]);
        }
        else {
            // Respond error when device is not found
            return response()->json([
                'success' => false,
                'message' => 'Device not found!',
            ], 500);            
        }
    }

    /**
     * get the device status.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDeviceStatus($id)
    {
        // Get device status by id
        $device = Device::find($id);
        if($device) {
            return response()->json([
                'success' => true,
                'status'=> $device->status
            ]);
        }
        else {
            // Respond error when device is not found
            return response()->json([
                'success' => false,
                'message' => 'Device not found!',
            ], 500);            
        }
    }

    /**
     * save the device temperature.
     *
     * @param  App\Http\Requests\API\V1\Device\TemperatureRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveDeviceTemperature(TemperatureRequest $request, $id)
    {

        // Update device temperature by id
        $device = Device::find($id);
        if($device) {
            $device->temperature = $request->temperature;
            $device->save();
            return response()->json([
                'success' => true,
                'message' => 'Device temperature is updated successfully!',
            ]);
        }
        else {
            // Respond error when device is not found
            return response()->json([
                'success' => false,
                'message' => 'Device not found!',
            ], 500);            
        }
    }

    /**
     * get the device temperature.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDeviceTemperature($id)
    {
        // Get device temperature by id
        $device = Device::find($id);
        if($device) {
            return response()->json([
                'success' => true,
                'temperature'=> $device->temperature
            ]);
        }
        else {
            // Respond error when device is not found
            return response()->json([
                'success' => false,
                'message' => 'Device not found!',
            ], 500);            
        }
    }

    /**
     * save the device airflow.
     *
     * @param  App\Http\Requests\API\V1\Device\AirflowRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveDeviceAirflow(AirflowRequest $request, $id)
    {
        // Update device airflow by id
        $device = Device::find($id);
        if($device) {
            $device->air_flow = $request->air_flow;
            $device->save();
            return response()->json([
                'success' => true,
                'message' => 'Device air_flow is updated successfully!',
            ]);
        }
        else {
            // Respond error when device is not found
            return response()->json([
                'success' => false,
                'message' => 'Device not found!',
            ], 500);            
        }
    }

    /**
     * get the device airflow.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDeviceAirflow($id)
    {
        // Get device airflow by id
        $device = Device::find($id);
        if($device) {
            return response()->json([
                'success' => true,
                'air_flow'=> $device->air_flow
            ]);
        }
        else {
            // Respond error when device is not found
            return response()->json([
                'success' => false,
                'message' => 'Device not found!',
            ], 500);            
        }
    }

    /**
     * save the device wind direction.
     *
     * @param  App\Http\Requests\API\V1\Device\WindDirectionRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveDeviceWindDirection(WindDirectionRequest $request, $id)
    {
        
        // Update device wind_direction by id
        $device = Device::find($id);
        if($device) {
            $device->wind_direction = $request->wind_direction;
            $device->save();
            return response()->json([
                'success' => true,
                'message' => 'Device wind_direction is updated successfully!',
            ]);
        }
        else {
            // Respond error when device is not found
            return response()->json([
                'success' => false,
                'message' => 'Device not found!',
            ], 500);            
        }
    }

    /**
     * get the device wind_direction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDeviceWindDirection($id)
    {
        // Get device wind_direction by id
        $device = Device::find($id);
        if($device) {
            return response()->json([
                'success' => true,
                'air_flow'=> $device->wind_direction
            ]);
        }
        else {
            // Respond error when device is not found
            return response()->json([
                'success' => false,
                'message' => 'Device not found!',
            ], 500);            
        }
    }

    

    /**
     * Display the specified device.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDevice($id)
    {
        // Get device by id
        $device = Device::find($id);
        if($device) {
            return response()->json([
                'success' => true,
                'device'=> $device
            ]);
        }
        else {
            // Respond error when device is not found
            return response()->json([
                'success' => false,
                'message' => 'Device not found!',
            ], 500);            
        }
    }


     /**
     * Display a listing of the devices.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        // List all devices
        $devicelist = Device::get();
        if($devicelist) {
            return response()->json([
                'success' => true,
                'data'=> $devicelist
            ]);
        }
        else {
            // When device is not found
            return response()->json([
                'success' => true,
                'message' => 'There is no devices!',
            ]);            
        }
    }


}
