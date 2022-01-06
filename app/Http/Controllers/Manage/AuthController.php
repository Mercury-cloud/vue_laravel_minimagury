<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(){
        return view('manage.login');
    } 

    public function logout() {
        auth()->guard('admin')->logout();
        return redirect()->route('manage.login');
    }

    public function loginAttempt(Request $request) {
        $credentials = $request->only('email','password');
        if(Auth::guard('admin')->attempt($credentials)){
            return redirect()->route('manage.user.index');
        }else{
            return redirect()->back()->with('error', 'ログインに失敗しました、入力内容をご確認下さい');
        }
    }

    public function index() {
        return redirect()->route('manage.user.index');
    }

}
