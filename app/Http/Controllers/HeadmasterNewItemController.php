<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database;
use Illuminate\Support\Facades\Hash;
use App\Emails;
use App\Subjects;
use App\ClassMain;
use App\Grades;
use App\User;
use Session;
use Validator;

class HeadmasterNewItemController extends Controller
{
  public function AddNewUser(Request $request) {
      $validator = Validator::make($request->all(), [
          'first_name' => 'required|min:2|max:50',
          'last_name' => 'required|min:2|max:64',
          'username' => 'required|min:3|max:50',
          'password' => 'required|min:8|max:50',
          'password_conf' => 'required|min:8|max:50',
          'role_id' => 'required|digits_between:1,3'
      ]);
      if (!$validator->fails()) {
          $new_user = new User;
          $new_user->first_name = $request->first_name;
          $new_user->last_name = $request->last_name;
          $new_user->username = $request->username;
          $new_user->password = Hash::make($request->password);
          $new_user->role_id = $request->role_id;

          $email_notif = new Emails;

          try {
              $new_user->save();
              $email_notif->user_id = $new_user->id;
              $email_notif->save();
          }
          catch (QueryException $e){
              Session::flash('wrong_info',"New user could not be created, make sure you entered correct values");
          }
          return redirect()->route('user_list');
        }
        else {
            Session::flash('wrong_info','The values you entered are invalid! Make sure your password is at least 8 characters long!');
            $input['first'] = $request->first_name;
            $input['last'] = $request->last_name;
            $input['username'] = $request->username;
        }
        return view('add_user_form',['input' => $input]);
  }

  public function AddNewUserIndex() {
      $input['first'] = '';
      $input['last'] = '';
      $input['username'] = '';
      return view('add_user_form',['input' => $input]);
  }

  public function AddNewSubject(Request $request) {
      $validator = Validator::make($request->all(), [
          'subject_name' => 'required|min:2|max:50',
          'teacher_id' => 'required'
      ]);
      if (!$validator->fails()) {
          $new_subject = new Subjects;
          $new_subject->name = $request->subject_name;
          $new_subject->leading_teacher = $request->teacher_id;
          try {
              $new_subject->save();
          }
          catch (QueryException $e){
              Session::flash('wrong_info',"$e");
          }
          return redirect()->route('subject_list');
      }
      else {
          Session::flash('wrong_info','There has been problem adding that subject!');
      }
      $teachers = User::select('users.id','users.first_name','users.last_name')->join('roles','users.role_id','=','roles.id')->where('roles.slug','=','teacher')->get();
      return view('add_subject_form',['teachers' => $teachers]);
  }

    public function AddNewSubjectIndex() {
        $teachers = User::select('users.id','users.first_name','users.last_name')->join('roles','users.role_id','=','roles.id')->where('roles.slug','=','teacher')->get();
        return view('add_subject_form',['teachers' => $teachers]);
    }

    public function AddNewClass(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:10'
        ]);
        if (!$validator->fails()) {
            $new_class = new ClassMain;
            $new_class->name = $request->name;
            try {
                $new_class->save();
            }
            catch (QueryException $e){
                Session::flash('wrong_info',"$e");
            }
            return redirect()->route('class_list');
        }
        else {
            Session::flash('wrong_info','There has been problem adding that class!');
        }
        $subjects = Subjects::get();
        return view('add_class_form',['subjects' => $subjects]);
    }

      public function AddNewClassIndex() {
          $subjects = Subjects::get();
          return view('add_class_form',['subjects' => $subjects]);
      }
}
