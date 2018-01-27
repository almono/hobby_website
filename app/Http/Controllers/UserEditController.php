<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\Subjects;
use App\ClassMain;
use App\Emails;
use Session;
use Validator;

class UserEditController extends Controller
{
  public function ViewUser(Request $request) {
    $user_id = $request->input("user_id");
    $user = User::with('roles')->where('users.id','=',$user_id)->first();
    if ($user->isTeacher()) {
        $subjects = Subjects::get();
        return view('user_edit',['user' => $user,'subjects' => $subjects]);
    }
    else if ($user->isStudent()) {
        $classes = ClassMain::get();
        return view('user_edit',['user' => $user,'classes' => $classes]);
    }
    else {
        return view('user_edit',['user' => $user]);
    }
  }

  public function EditUser(Request $request) {
      $validator = Validator::make($request->all(), [
          'new_first_name' => 'nullable|min:2|max:50',
          'new_last_name' => 'nullable|min:2|max:64',
          'new_username' => 'nullable|min:3|max:50',
          'new_password' => 'nullable|min:8|max:50',
          'subject_id' => 'nullable|integer',
          'class_id' => 'nullable|integer',
          'user_id' => 'nullable|integer'
        ]);
      if (!$validator->fails()) {
          $new_first = $request->input("new_first_name");
          $new_last = $request->input("new_last_name");
          $new_username = $request->input("new_username");
          $new_password = $request->input("new_password");
          $new_subject = $request->input("subject_id");
          $new_class = $request->input("class_id");
          $id = $request->input("user_id");
          //for now multiple ifs until i figure out how to validate or check it in another way
          $user = User::where('id','=',$id)->first();
          $subject = Subjects::where('id','=',$new_subject)->first();
          if (!is_null($new_first)) {
              $user->first_name = $new_first;
          }
          if (!is_null($new_last)) {
              $user->last_name = $new_last;
          }
          if (!is_null($new_username)) {
              $user->username = $new_username;
          }
          if (!is_null($new_password)) {
              $user->password = Hash::make($new_password);
          }
          if (!is_null($new_class)) {
              $user->class_id = $new_class;
          }
          if (!is_null($new_subject)) {
              $subject->leading_teacher = $id;
          }
          try {
            $user->save();
                if (!is_null($subject)) {
                    $subject->save();
                }
          }
          catch (QueryException $e){
              Session::flash('invalid_data',"You entered wrong values or there is already an user with that username!");
              return redirect()->route('user_list');
          }
  }
  else {
      Session::flash('invalid_data',"The values you entered are incorrect!");
  }
  return redirect()->route('user_list');
  }

  public function DeleteUser(Request $request) {
      $id = $request->input("user_id");
      $user = User::where('id','=',$id)->first();
      $email_notif = Emails::where('user_id','=',$id)->first();

      try {
          if (isset($email_notif)) {
              $email_notif->delete();
          }
          $user->delete();
      }
      catch (QueryException $e){
          Session::flash('invalid_data',"You are not allowed to delete this user!!");
          return redirect()->route('user_list');
      }
    return redirect()->route('user_list');
  }
}
