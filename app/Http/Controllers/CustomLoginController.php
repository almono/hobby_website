<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use \App\User;
use Session;

class CustomLoginController extends Controller
{
    public function custom_login(Request $request) {
        $username = $request->input("username");
        $password = $request->input("password");
        $user = User::select('users.id','users.username','users.role_id','roles.slug as role_name','users.password','users.first_name','users.last_name')->join('roles','roles.id','=','users.role_id')->where('username','=',$username)->first();
        if (!is_null($user)) {
            if (Hash::check($password,$user->password) && isset($username) && isset($password)){
                Session::put('user',$user);
                return redirect()->route('home');
            }
            else {
                Session::flash('message','You have given me the wrong credentials >:(');
                return view('login');
            }
        }
        else {
            Session::flash('message','That user does not exist!!! D:');
            return view('login');
        }

    }
}
