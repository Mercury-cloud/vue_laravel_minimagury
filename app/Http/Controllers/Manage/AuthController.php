<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('manage.login');
    }


    public function user (Request $request, User $managers){
        $managers = User::orderby('id','DESC')->paginate(10);
        return view('manage.user',[
            'managers'=>$managers,
        ]);
    }

    public function logout() {
        return redirect()->route('manage.login');
    }

}

