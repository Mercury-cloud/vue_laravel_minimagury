<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
    public function store(User $user, Request $request) {
        // 追加の時に動く
        if ($user == null) {
            $user = new User();
        }
        
        $user->fill($request->all());
        if ($request->has('password')) {// パスワードが有れば
            $user->password = bcrypt($request->get('password'));
        }
        $user->save();
        return redirect()->route('manage.user.index');
    }
    // user/add
    public function delete(User $user) {
        // 削除処理書く
        $user->delete();
        return redirect()->route('manage.user.index');
    }

}
