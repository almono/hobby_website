<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Session;

class LogoutController extends Controller
{
    public function Logout() {
        Session::forget('user');
        return redirect()->route('login');
    }
}
