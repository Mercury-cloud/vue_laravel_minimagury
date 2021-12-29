<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Timelapse;

class TimelapseController extends Controller
{
    public function add_timelapse(Request $request)
    {   
        $data = $request->only('name', 'interval', 'setting');
        $validator = Validator::make($data, [
            'name' => 'required|string|unique:scenes',
            'interval' => 'required|numeric',
            'setting' => 'required|string'
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $newTimelapse = Timelapse::create([
            'name' => $request->name,
            'interval' => $request->interval,
            'setting' => $request->setting
        ]);
        //Timelapse created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Timelapse "'.$request->name.'" is created successfully',
            'data' => $newTimelapse
        ], Response::HTTP_OK);
    }

    public function edit_timelapse_info(Request $request, $id)
    {
        // Timelapse update with request data
        $timelapse = Timelapse::find($id);
        if($timelapse) {
            $timelapse->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Timelapse info is updated successfully!',
            ]);
        }
        else {
            // Respond error when timelapse is not found
            return response()->json([
                'success' => false,
                'message' => 'Timelapse not found!',
            ], 500);            
        }
    }

    public function delete_timelapse(Request $request, $id)
    {
        // Timelapse delete by id
        $timelapse = Timelapse::find($id);
        if($timelapse) {
            $timelapse->delete();
            return response()->json([
                'success' => true,
                'message' => 'Timelapse is deleted successfully!',
            ]);
        }
        else {
            // Respond error when timelapse is not found
            return response()->json([
                'success' => false,
                'message' => 'Timelapse not found!',
            ], 500);            
        }
    }

    public function get_timelapse(Request $request, $id)
    {
        // Get timelapse by id
        $timelapse = Timelapse::find($id);
        if($timelapse) {
            return response()->json([
                'success' => true,
                'data'=> $timelapse
            ]);
        }
        else {
            // Respond error when timelapse is not found
            return response()->json([
                'success' => false,
                'message' => 'Timelapse not found!',
            ], 500);            
        }
    }

    public function get_timelapse_url(Request $request, $id)
    {
        // Get timelapse by id
        $timelapse = Timelapse::find($id);
        if($timelapse) {
            return response()->json([
                'success' => true,
                'share_url'=> $timelapse->share_url
            ]);
        }
        else {
            // Respond error when timelapse is not found
            return response()->json([
                'success' => false,
                'message' => 'Timelapse not found!',
            ], 500);            
        }
    }

    
}
