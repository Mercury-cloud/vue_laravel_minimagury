<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;

class DeviceController extends Controller
{

   
    /**
     * Store a newly created device into the DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_device(Request $request)
    {   
        $data = $request->only('name', 'type', 'user_id', 'field_id');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'type' => ['required', Rule::in(['switch', 'air_conditioner'])],
            'user_id' => 'required|numeric',
            'field_id' => 'required|numeric',
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_device_info(Request $request, $id)
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
    public function delete_device_info(Request $request, $id)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save_device_status(Request $request, $id)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_device_status(Request $request, $id)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save_device_temperature(Request $request, $id)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_device_temperature(Request $request, $id)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save_device_airflow(Request $request, $id)
    {
        $data = $request->only('air_flow');
        $validator = Validator::make($data, [
            'air_flow' => ['required', Rule::in(['low', 'mid', 'high', 'auto', 'power'])],
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_device_airflow(Request $request, $id)
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save_device_wind_direction(Request $request, $id)
    {
        $data = $request->only('wind_direction');
        $validator = Validator::make($data, [
            'wind_direction' => ['required', Rule::in(['vertical', 'horizontal', 'auto'])],
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_device_wind_direction(Request $request, $id)
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
    public function show_device($id)
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
    public function list_device()
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
