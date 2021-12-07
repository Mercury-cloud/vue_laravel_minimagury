<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;


class UserController extends Controller
{
    // user/
    public function index() {
        $users = User::orderby('id','DESC')->paginate(10);
        return view('manage.user.index', ['users' => $users]);
    }
    // user/add
    public function add() {
        $user = new User();
        return view('manage.user.form', ['user' => $user]);
    }
    // user/edit
    public function edit(User $user) {
        //dd($user->toArray());
        //dd($user->toArray());
        return view('manage.user.form', ['user' => $user]);
    }

    public function store(User $user, StorePostRequest $request) {

        
        if($request->has('password')) {// パスワードが有れば
            $user->password = bcrypt($request->get('password'));
        }

        $user->fill($request->all());
        $user->save();

        return redirect()->route('manage.user.index');
    }

    
    // user/delete
    public function delete(User $user) {
        // 削除処理書く
        $user->delete();
        return redirect()->route('manage.user.index');
    }

}

