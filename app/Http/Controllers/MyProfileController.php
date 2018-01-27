<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \App\User;
use Session;

class MyProfileController extends Controller
{
    public function UpdateField(Request $request) {
        $new_password = $request->input("new_password");
        if (!is_null($new_password)){
            $user = User::where('username','=',session('user.username'))->first();
            $user->password = Hash::make($new_password);
            $user->save();
            return view('my_profile');
        }
        else {
            Session::flash('wrong_new','Please input a correct password!');
            return view('my_profile');
        }
    }

    public function index() {
        return view('my_profile');
    }
}
