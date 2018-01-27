<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\Subjects;
use App\User;
use Session;
use Validator;

class SubjectEditController extends Controller
{
  public function ViewSubject(Request $request) {
      $subject_id = $request->input("subject_id");
      $teachers = User::select('users.id','users.first_name','users.last_name')->join('roles','users.role_id','=','roles.id')->where('roles.slug','=','teacher')->get();
      $subject = Subjects::where('id','=',$subject_id)->first();
      return view('subject_edit',['subject' => $subject, 'teachers' => $teachers]);
  }

  public function EditSubject(Request $request) {
      $validator = Validator::make($request->all(), [
          'new_subject_name' => 'nullable|string',
          'teacher_id' => 'nullable|integer',
          'subject_id' => 'nullable|integer'
      ]);
      if (!$validator->fails()) {
          $new_name = $request->input("new_subject_name");
          $new_teacher = $request->input("teacher_id");
          $id = $request->input("subject_id");
          $subject = Subjects::where('id','=',$id)->first();
          if (!is_null($new_name)) {
              $subject->name = $new_name;
          }
          $subject->leading_teacher = $new_teacher;
          try {
              $subject->save();
          }
          catch (QueryException $e){
              Session::flash('data',"You entered wrong values or there is already a subject with that name!");
          }
      }
      else {
          Session::flash('data',"Oops something went wrong");
      }
      return redirect()->route('subject_list');
  }

  public function DeleteSubject(Request $request) {
      $id = $request->input("subject_id");
      $subject = Subjects::where('id','=',$id)->first();
      try {
          $subject->delete();
      }
      catch (QueryException $e){
          Session::flash('data',"Subject could not be deleted");
          return redirect()->route('subject_list');
      }
      Session::flash('data',"Subject has been deleted!");
      return redirect()->route('subject_list');
  }

}
