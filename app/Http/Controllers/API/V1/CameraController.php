<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Camera\AddRequest;
use App\Http\Requests\API\V1\Camera\TypeRequest;
use App\Http\Requests\API\V1\Camera\ForTimelapseRequest;
use App\Http\Requests\API\V1\Camera\EditRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Camera;

class CameraController extends Controller
{
    public function addCamera(AddRequest $request)
    {   
        $newCamera = Camera::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'field_id' => $request->field_id,
        ]);
        //Camera created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Camera "'.$request->name.'" is registered successfully',
            'data' => $newCamera
        ], Response::HTTP_OK);
    }

    public function listCameras()
    {
        // List all cameras
        $cameralist = Camera::get();
        if($cameralist) {
            return response()->json([
                'success' => true,
                'data'=> $cameralist
            ]);
        }
        else {
            // When camera is not found
            return response()->json([
                'success' => true,
                'message' => 'There is no camera!',
            ]);            
        }
    }

    public function getCameraByField($field_id)
    {
        // Get Cameras by field id
        $cameras = Camera::where('field_id', '=', $field_id)->get();
        if(count($cameras)) {
            return response()->json([
                'success' => true,
                'cameras'=> $cameras
            ]);
        }
        else {
            // Respond error when camera is not found
            return response()->json([
                'success' => false,
                'message' => 'camera not found!',
            ], 500);            
        }
    }

    public function getCameraRecordData($id)
    {
        // Get camera value by id
        $camera = Camera::find($id);
        if($camera) {
            return response()->json([
                'success' => true,
                'record_data'=> $camera->file
            ]);
        }
        else {
            // Respond error when camera is not found
            return response()->json([
                'success' => false,
                'message' => 'Camera not found!',
            ], 500);            
        }
    }

    public function saveCameraType(TypeRequest $request, $id)
    {
        // Update camera type by id
        $camera = Camera::find($id);
        if($camera) {
            $camera->is_360_degree = $request->is_360_degree;
            $camera->save();
            return response()->json([
                'success' => true,
                'message' => 'Camera type is updated successfully!',
            ]);
        }
        else {
            // Respond error when camera is not found
            return response()->json([
                'success' => false,
                'message' => 'Camera not found!',
            ], 500);            
        }
    }

    public function getCameraDetail($id)
    {
        // Get camera value by id
        $camera = Camera::find($id);
        if($camera) {
            return response()->json([
                'success' => true,
                'camera'=> $camera
            ]);
        }
        else {
            // Respond error when camera is not found
            return response()->json([
                'success' => false,
                'message' => 'Camera not found!',
            ], 500);            
        }
    }

    public function editCameraForTimelapse(ForTimelapseRequest $request, $id)
    {
        // Update camera for_timelapse by id
        $camera = Camera::find($id);
        if($camera) {
            $camera->for_timelapse = $request->for_timelapse;
            $camera->save();
            return response()->json([
                'success' => true,
                'message' => 'Camera for_timelapse is updated successfully!',
            ]);
        }
        else {
            // Respond error when camera is not found
            return response()->json([
                'success' => false,
                'message' => 'Camera not found!',
            ], 500);            
        }
    }

    public function editCamera(EditRequest $request, $id)
    {
        // Camera update with request data
        $camera = Camera::find($id);
        if($camera) {
            $camera->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Camera info is updated successfully!',
            ]);
        }
        else {
            // Respond error when camera is not found
            return response()->json([
                'success' => false,
                'message' => 'Camera not found!',
            ], 500);            
        }
    }

    public function deleteCamera($id)
    {
        // Camera delete by id
        $camera = Camera::find($id);
        if($camera) {
            $camera->delete();
            return response()->json([
                'success' => true,
                'message' => 'Camera is deleted successfully!',
            ]);
        }
        else {
            // Respond error when camera is not found
            return response()->json([
                'success' => false,
                'message' => 'Camera not found!',
            ], 500);            
        }
    }

    
}
