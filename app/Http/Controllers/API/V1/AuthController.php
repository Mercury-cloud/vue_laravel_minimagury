<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class AuthController extends Controller
{
    /**
     * ログイン
     */
    public function test(Request $request) {
        dd('test');
    }
    public function login(LoginRequest $request) {
        $credential = $request->only(['email', 'password']);
        if (Auth::attempt($credential, false)) {
            auth()->user()->api_token = Str::random(60);
            auth()->user()->save();
            return response()->json(["success" => 'ログインしました', 'api_token' => auth()->user()->api_token, 'user' => auth()->user()]);
        } else {
            return response()->json(["errors" => 'ログインに失敗しました、メールアドレスと、パスワードをご確認下さい']);
        }
    }

}
