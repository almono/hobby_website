<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Item;
use App\Category;
use Session;
use Validator;

class UserController extends Controller
{

    protected function create(Request $request)
    {
        $data = $request->all(); //dd($data);
        $user = new User;

        $user->username = $data['username'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->gender = $data['gender'];
        $user->city = $data['city'];
        $user->zip_code = $data['zip_code'];
        $user->address = $data['address'];
        $user->phone_number = $data['phone'];
        $user->active = '1';

        $user->save();

        return redirect()->route('home');
    }

    public function my_account() {

        $user_id = User::UserID();
        $user = User::find($user_id);

        return view('front.my_account',['user' => $user]);

    }

    public function admin_login() {
        if (Auth::check()) {
            return redirect('/admin');
        }
        else {
            return view('front.admin_login');
        }
    }

    public function admin_panel() {
        if (!Auth::check()) {
            return redirect('/admin_login');
        }
        else {
            $categories = Category::get();
            $items = Item::get();
            return view('front.admin',['categories' => $categories, 'items' => $items]);
        }
    }

}
