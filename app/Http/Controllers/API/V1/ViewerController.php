<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Viewer\AddRequest;
use App\Http\Requests\API\V1\Viewer\EditRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\Viewer;
use App\Models\ViewerCameraRelation;
use App\Models\ViewerSensorRelation;
use App\Models\Camera;
use App\Models\Sensor;
use App\Models\LogSensor;


class ViewerController extends Controller
{
    public function addViewer(AddRequest $request)
    {   
        $newViewer = Viewer::create([
            'user_id' => $request->user_id,
            'login_id' => $request->login_id,
            'password_text' => $request->password_text,
            'expiration_date' => $request->expiration_date,
            'password' => bcrypt($request->password)
        ]);
        //Viewer created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Viewer "'.$request->name.'" is created successfully',
            'data' => $newViewer
        ], Response::HTTP_OK);
    }

    public function editViewerInfo(EditRequest $request, $id)
    {
        // Viewer update with request data
        $viewer = Viewer::find($id);
        if($viewer) {
            $viewer->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Viewer info is updated successfully!',
            ]);
        }
        else {
            // Respond error when viewer is not found
            return response()->json([
                'success' => false,
                'message' => 'Viewer not found!',
            ], 500);            
        }
    }

    public function deleteViewer(Request $request, $id)
    {
        // Viewer delete by id
        $viewer = Viewer::find($id);
        if($viewer) {
            $viewer->delete();
            return response()->json([
                'success' => true,
                'message' => 'Viewer is deleted successfully!',
            ]);
        }
        else {
            // Respond error when viewer is not found
            return response()->json([
                'success' => false,
                'message' => 'Viewer not found!',
            ], 500);            
        }
    }

    public function listViewer(Request $request)
    {
        // list viewers
        $viewerlist = Viewer::get();
        if($viewerlist) {
            return response()->json([
                'success' => true,
                'viewers'=> $viewerlist
            ]);
        }
        else {
            // Respond error when viewer is not found
            return response()->json([
                'success' => false,
                'message' => 'Viewer not found!',
            ], 500);            
        }
    }

    public function getMainViewData(Request $request, $id)
    {
        // get relations from viewer
        $viewerCameraRelation = ViewerCameraRelation::where("viewer_id", $id)->get();
        $viewerSensorRelation = ViewerSensorRelation::where("viewer_id", $id)->get();

        $cameraArr = array();
        foreach ($viewerCameraRelation as $each1) {
            array_push($cameraArr, Camera::find($each1->camera_id));
        }

        $sensorArr = array();
        foreach ($viewerSensorRelation as $each2) {
            $sensor = Sensor::find($each2->sensor_id);
            $sensorLogs = LogSensor::where('sensor_id', $each2->sensor_id)->get();
            $sensorObj = [
                "name" => $sensor->name,
                "description" => $sensor->description,
                "logs" => $sensorLogs
            ];
            array_push($sensorArr, $sensorObj);
        }
        return response()->json([
            'success' => true,
            'data'=> [
                "cameras" => $cameraArr,
                "sensors" => $sensorArr
            ]
        ]);
        
    }

    public function getLogDetail(Request $request, $id)
    {
        // get relations from viewer
        $viewerSensorRelation = ViewerSensorRelation::where("viewer_id", $id)->first();
        $sensor = Sensor::find($viewerSensorRelation->sensor_id);
        $sensorLogs = LogSensor::where('sensor_id', $viewerSensorRelation->sensor_id)->paginate($request->pagination);
        
        return response()->json([
            'success' => true,
            'data'=> [
                "sensor" => $sensor,
                "logs" => $sensorLogs
            ]
        ]);
        
    }

    public function getRelations(Request $request, $id)
    {
        // get relations from viewer
        $viewer = Viewer::find($id);
        $viewerCameraRelation = ViewerCameraRelation::where("viewer_id", $id)->get();
        $viewerSensorRelation = ViewerSensorRelation::where("viewer_id", $id)->get();
        if($viewer) {
            return response()->json([
                'success' => true,
                'viewer' => $viewer,
                'camera_relations'=> $viewerCameraRelation,
                'sensor_relations'=> $viewerSensorRelation,
            ]);
        }
        else {
            // Respond error when viewer is not found
            return response()->json([
                'success' => false,
                'message' => 'Viewer not found!',
            ], 500);            
        }
    }



    public function editCameraRelation(Request $request, $id)
    {
        // Viewer update with request data
        $viewerCameraRelation = ViewerCameraRelation::where("viewer_id", $id)->first();
        if($viewerCameraRelation) {
            $viewerCameraRelation->camera_id = $request->camera_id;
            $viewerCameraRelation->save();
            return response()->json([
                'success' => true,
                'message' => 'Viewer Camera relation is updated successfully!',
            ]);
        }
        else {
            ViewerCameraRelation::create([
                'viewer_id' => $id,
                'camera_id' => $request->camera_id,
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Viewer Camera relation is created successfully!',
            ]);            
        }
    }

    public function editSensorRelation(Request $request, $id)
    {
        // Viewer update with request data
        $viewerSensorRelation = ViewerSensorRelation::where("viewer_id", $id)->first();
        if($viewerSensorRelation) {
            $viewerSensorRelation->sensor_id = $request->sensor_id;
            $viewerSensorRelation->save();
            return response()->json([
                'success' => true,
                'message' => 'Viewer Sensor relation is updated successfully!',
            ]);
        }
        else {
            ViewerSensorRelation::create([
                'viewer_id' => $id,
                'sensor_id' => $request->sensor_id,
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Viewer Sensor relation is created successfully!',
            ]);            
        }
    }

    public function viewerLogin(Request $request)
    {   
        $viewer = Viewer::where("user_id", "=", $request->user_id)->where("login_id", "=", $request->login_id)->first();
        if($viewer) {
            $passwordMatch = Hash::check($request->password, $viewer->password);
            if(!$passwordMatch) {
                //return success response
                return response()->json([
                    'success' => false,
                    'message' => 'Password mismatch!',
                ], Response::HTTP_OK);
            } else {
                //return success response
                return response()->json([
                    'success' => false,
                    'message' => 'Viewer logged in successfully!',
                ], Response::HTTP_OK);
            }
        } else {
            // Respond error when viewer is not found
            return response()->json([
                'success' => false,
                'message' => 'Viewer not found!',
            ], 500);   
        }
    }


}
