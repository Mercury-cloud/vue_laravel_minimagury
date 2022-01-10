<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\V1\Scene\AddRequest;
use App\Http\Requests\API\V1\Scene\EditRequest;
use App\Http\Requests\API\V1\Scene\ConditionAddRequest;
use App\Http\Requests\API\V1\Scene\ConditionEditRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Scene;
use App\Models\SceneCondition;

class SceneController extends Controller
{
    

    /**
     * Store a newly created scene in DB.
     *
     * @param  App\Http\Requests\API\V1\Scene\AddRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function addScene(AddRequest $request)
    {
        $newScene = Scene::create([
            'name' => $request->name,
            'device_id' => $request->device_id
        ]);
        //Scene created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Scene "'.$request->name.'" is created successfully',
            'data' => $newScene
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified scene.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showScene($id)
    {
        // Get scene by id
        $scene = Scene::find($id);
        if($scene) {
            return response()->json([
                'success' => true,
                'scene'=> $scene
            ]);
        }
        else {
            // Respond error when scene is not found
            return response()->json([
                'success' => false,
                'message' => 'Scene not found!',
            ], 500);            
        }
    }

    

    /**
     * Update the scene.
     *
     * @param  App\Http\Requests\API\V1\Scene\EditRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSceneInfo(EditRequest $request, $id)
    {
        // Scene update with request data
        $scene = Scene::find($id);
        if($scene) {
            $scene->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Scene info is updated successfully!',
            ]);
        }
        else {
            // Respond error when scene is not found
            return response()->json([
                'success' => false,
                'message' => 'Scene not found!',
            ], 500);            
        }
    }

    /**
     * Remove the scene.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteScene($id)
    {
        // Scene delete by id
        $scene = Scene::find($id);
        if($scene) {
            $scene->delete();
            return response()->json([
                'success' => true,
                'message' => 'Scene is deleted successfully!',
            ]);
        }
        else {
            // Respond error when scene is not found
            return response()->json([
                'success' => false,
                'message' => 'Scene not found!',
            ], 500);            
        }
    }

    /**
     * Display a listing of the scenes.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        // List all scenes
        $scenelist = Scene::get();
        if($scenelist) {
            return response()->json([
                'success' => true,
                'data'=> $scenelist
            ]);
        }
        else {
            // When scene is not found
            return response()->json([
                'success' => true,
                'message' => 'There is no scenes!',
            ]);            
        }
    }
    
    /**
     * Add a new scene condition in the DB.
     *
     * @param  App\Http\Requests\API\V1\Scene\ConditionAddRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function addSceneCondition(ConditionAddRequest $request)
    {
        $newSceneCondition = SceneCondition::create([
            'name' => $request->name,
            'scene_id' => $request->scene_id,
            'type' => $request->type
        ]);
        //Scene condition created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Scene Condition "'.$request->name.'" is created successfully',
            'data' => $newSceneCondition
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified scene condition.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSceneCondition($id)
    {
        // Get scene condition by id
        $sceneCondition = SceneCondition::find($id);
        if($sceneCondition) {
            return response()->json([
                'success' => true,
                'sceneCondition'=> $sceneCondition
            ]);
        }
        else {
            // Respond error when scene condition is not found
            return response()->json([
                'success' => false,
                'message' => 'Scene condition not found!',
            ], 500);            
        }
    }

    

    /**
     * Update the scene condition.
     *
     * @param  App\Http\Requests\API\V1\Scene\ConditionEditRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSceneCondition(ConditionEditRequest $request, $id)
    {
        // Scene condition update with request data
        $sceneCondition = SceneCondition::find($id);
        if($sceneCondition) {
            $sceneCondition->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Scene Condition is updated successfully!',
            ]);
        }
        else {
            // Respond error when scene condition is not found
            return response()->json([
                'success' => false,
                'message' => 'Scene Condition not found!',
            ], 500);            
        }
    }

    /**
     * Remove the scene condition.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSceneCondition($id)
    {
        // Scene Condition delete by id
        $sceneCondition = SceneCondition::find($id);
        if($sceneCondition) {
            $sceneCondition->delete();
            return response()->json([
                'success' => true,
                'message' => 'SceneCondition is deleted successfully!',
            ]);
        }
        else {
            // Respond error when sceneCondition is not found
            return response()->json([
                'success' => false,
                'message' => 'SceneCondition not found!',
            ], 500);            
        }
    }

    /**
     * Display a listing of the sceneConditions.
     *
     * @return \Illuminate\Http\Response
     */
    public function listSceneCondition()
    {
        // List all sceneConditions
        $sceneConditionList = SceneCondition::get();
        if($sceneConditionList) {
            return response()->json([
                'success' => true,
                'data'=> $sceneConditionList
            ]);
        }
        else {
            // When sceneCondition is not found
            return response()->json([
                'success' => true,
                'message' => 'There is no sceneCondition!',
            ]);            
        }
    }

    /**
     * Display the sensor by scene Id.
     *
     * @param  int  $scene_id
     * @return \Illuminate\Http\Response
     */
    public function showSensorByScene($scene_id)
    {
        // Get SceneCondition by scene id
        $scene_conditions = SceneCondition::where('scene_id', '=', $scene_id)->get();
        if(count($scene_conditions)) {
            $sensorArr = array();
            foreach ($scene_conditions as $scene_condition) {
                $sensor = Sensor::find($scene_condition->sensor_id);
                if($sensor) {
                    array_push($sensorArr, $sensor);
                } else {
                    array_push($sensorArr, ["error" => true, "message" => "sensor not found"]);
                }
            }
            return response()->json([
                'success' => true,
                'sensors'=> $sensorArr
            ]);
        }
        else {
            // Respond error when sceneCondition is not found
            return response()->json([
                'success' => false,
                'message' => 'SceneCondition not found!',
            ], 500);            
        }
    }

    
    /**
     * Display the scene by device Id.
     *
     * @param  int  $device_id
     * @return \Illuminate\Http\Response
     */
    public function showSceneByDevice($device_id)
    {
        // Get Scene by device id
        $scenes = Scene::where('device_id', '=', $device_id)->get();
        if(count($scenes)) {
            return response()->json([
                'success' => true,
                'scenes'=> $scenes
            ]);
        }
        else {
            // Respond error when scene is not found
            return response()->json([
                'success' => false,
                'message' => 'scene not found!',
            ], 500);            
        }
    }

}
