<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Setting\SplashRequest;
use App\Http\Requests\API\V1\Setting\PasswordRequest;
use App\Http\Requests\API\V1\Setting\EmailRequest;
use App\Http\Requests\API\V1\Setting\NameRequest;
use App\Http\Requests\API\V1\Setting\ColorRequest;
use App\Http\Requests\API\V1\Setting\AlertRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Sensor;
use App\Models\SensorDetail;
use App\Models\Device;
use App\Models\User;

class SettingController extends Controller
{
    public function settingGetList()
    {
        // List user settings
        $settingInfo = [
            'email' => auth()->user()->email,
            'name' => auth()->user()->name,
            'splash_file' => auth()->user()->splash_file,
            'push_permission' => auth()->user()->push_permission,
            'push_alert' => auth()->user()->push_alert,
            'push_scene' => auth()->user()->push_scene,
            'push_camera_shot' => auth()->user()->push_camera_shot,
            'auth_code' => auth()->user()->auth_code,
            'splash_color' => auth()->user()->splash_color,
            'theme_color' => auth()->user()->theme_color,
            'background_color' => auth()->user()->background_color,
        ];
        
        return response()->json([
            'success' => true,
            'setting_data'=> $settingInfo
        ]);
        
    }

    public function settingSplashGet()
    {
        // Get splash setting
        return response()->json([
            'success' => true,
            'splash_setting'=> [
                'splash_file' => auth()->user()->splash_file,
                'splash_color' => auth()->user()->splash_color,
            ]
        ]);
    }

    public function settingSplashSet(SplashRequest $request)
    {
        auth()->user()->splash_file = $request->splash_file;
        auth()->user()->splash_color = $request->splash_color;
        auth()->user()->save();
        //Splash created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Splash info is saved successfully',
            'user' => auth()->user()
        ], Response::HTTP_OK);
    }

    public function settingUserPassword(PasswordRequest $request)
    {
        auth()->user()->password = bcrypt($request->password);
        auth()->user()->save();

        //User password updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'password updated!',
            'user' => auth()->user()
        ], Response::HTTP_OK);
    }

    public function settingUserName(NameRequest $request)
    {
        auth()->user()->name = $request->name;
        auth()->user()->save();

        //User password updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'user name updated successfully!',
            'user' => auth()->user()
        ], Response::HTTP_OK);
    }

    public function settingUserEmail(EmailRequest $request)
    {
        auth()->user()->email = $request->email;
        auth()->user()->save();
        
        //User password updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'email updated successfully!',
            'user' => auth()->user()
        ], Response::HTTP_OK);
    }

    public function settingUserColor(ColorRequest $request)
    {
        auth()->user()->theme_color = $request->theme_color;
        auth()->user()->background_color = $request->background_color;
        auth()->user()->save();
        
        //User password updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'color updated successfully!',
            'user' => auth()->user()
        ], Response::HTTP_OK);
    }

    public function settingUserAlert(AlertRequest $request)
    {
        auth()->user()->push_alert = $request->alert_occur || $request->scene_run || $request->camera_run;
        auth()->user()->save();
        
        //User password updated, return success response
        return response()->json([
            'success' => true,
            'message' => 'alert setting updated successfully!',
            'user' => auth()->user()
        ], Response::HTTP_OK);
    }
    
}
