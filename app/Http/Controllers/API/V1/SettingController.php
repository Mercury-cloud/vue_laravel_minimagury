<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Sensor;
use App\Models\SensorDetail;
use App\Models\Device;
use App\Models\Splash;
use App\Models\User;

class SettingController extends Controller
{
    public function settingGetList(Request $request)
    {
        // List all sensors
        $sensorlist = Sensor::get();
        $devicelist = Device::get();
        if(count($sensorlist)) {
            $sensorResult = array();
            foreach ($sensorlist as $sensor) {
                $sensorDetail = SensorDetail::where("sensor_id", $sensor->id)->get();
                array_push($sensorResult, [
                    "sensor" => $sensor,
                    "sensorDetail" => $sensorDetail
                ]);
            }
            return response()->json([
                'success' => true,
                'data'=> [
                    "sensors" => $sensorResult,
                    "devices" => $devicelist
                ]
            ]);
        }
        else {
            // When camera is not found
            return response()->json([
                'success' => true,
                'data' => [
                    "sensors" => $sensorlist,
                    "devices" => $devicelist
                ],
            ]);            
        }
    }

    public function settingSplashGet(Request $request)
    {
        // List all splashes
        $splashlist = Splash::get();
        if($splashlist) {
            return response()->json([
                'success' => true,
                'splashes'=> $splashlist
            ]);
        }
        else {
            // When splash is not found
            return response()->json([
                'success' => true,
                'message' => 'There is no splash!',
            ]);            
        }
    }

    public function settingSplashSet(Request $request)
    {
        $data = $request->only('name', 'splash_content');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'splash_content' => 'required|string',
        ]);
        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $newSplash = Splash::create([
            'name' => $request->name,
            'splash_content' => $request->splash_content,
        ]);
        //Splash created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Splash "'.$request->name.'" is registered successfully',
            'data' => $newSplash
        ], Response::HTTP_OK);
    }

    public function settingUserPassword(Request $request)
    {
        $data = $request->only('password');

         //valid credential
         $validator = Validator::make($data, [
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        } 

        $user = User::where('api_token', '=', $request->token)->first();
        if($request->has('password')) {// パスワードが有れば
            $user->password = bcrypt($request->get('password'));
        }
        $user->save();

        //User password updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'password updated!',
            'user' => $user
        ], Response::HTTP_OK);
    }

    public function settingUserName(Request $request)
    {
        $data = $request->only('name');

        //valid credential
        $validator = Validator::make($data, [
            'name' => 'required|string',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $user = User::where('api_token', '=', $request->token)->first();
        if($request->has('name')) {
            $user->name = $request->get('name');
        }
        $user->save();

        //User password updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'user name updated to '.$request->name.'!',
            'user' => $user
        ], Response::HTTP_OK);
    }

    public function settingUserEmail(Request $request)
    {
        $data = $request->only('email');

        //valid credential
        $validator = Validator::make($data, [
            'email' => 'required|email',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $user = User::where('api_token', '=', $request->token)->first();
        if($request->has('email')) {
            $user->email = $request->get('email');
        }
        $user->save();

        //User password updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'email updated to '.$request->get('email').'!',
            'user' => $user
        ], Response::HTTP_OK);
    }
}
