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

class HeadmasterAssignmentController extends Controller
{
  public function AssignStudentIndex() {
      $students = User::select('users.id','users.first_name','users.last_name')->join('roles','users.role_id','=','roles.id')->where('roles.slug','=','student')->get();
      $classes = ClassMain::get();
      return view('assign_student',['students' => $students,'classes' => $classes]);
  }

  public function AssignStudent(Request $request) {
      $validator = Validator::make($request->all(), [
          'student_id' => 'required',
          'class_id' => 'required'
      ]);
      if (!$validator->fails()) {
          try {
              User::where('id','=',$request->student_id)->update(['class_id' => $request->class_id]);
          }
          catch (QueryException $e){
              Session::flash('wrong_data',"$e");
          }
          return redirect()->route('user_list');
      }
      else {
          Session::flash('wrong_info','There has been problem adding that subject!');
      }
      return redirect()->route('user_list');
  }

  public function AssignSubjectIndex() {
        $subjects = Subjects::get();
        $classes = ClassMain::get();
        return view('assign_subject',['subjects' => $subjects,'classes' => $classes]);
  }

  public function AssignSubject(Request $request) {
      $validator = Validator::make($request->all(), [
          'class_id' => 'required',
          'subject_id' => 'required'
      ]);
      if (!$validator->fails()) {
          $check = \DB::table('class_subject')->where([['class_id','=',$request->class_id],['subject_id','=',$request->subject_id]])->count();
          if ($check < 1) {
              try {
                  \DB::table('class_subject')->insert([
                      'class_id' => $request->class_id,
                      'subject_id' => $request->subject_id
                  ]);
              }
              catch (QueryException $e){
                  Session::flash('wrong_data',"$e");
              }
              return redirect()->route('class_list');
          }
          else {
              Session::flash('wrong_info','That class already has that as a subject!');
              return redirect()->route('class_list');
          }
      }
      else {
          Session::flash('wrong_info','There has been problem adding that subject!');
      }
      return redirect()->route('class_list');
  }

  public function AssignTeacherIndex() {
      $teachers = User::select('users.id','users.first_name','users.last_name')->join('roles','users.role_id','=','roles.id')->where('roles.slug','=','teacher')->get();
      $subjects = Subjects::get();
      return view('assign_teacher',['teachers' => $teachers,'subjects' => $subjects]);
  }

  public function AssignTeacher(Request $request) {
      $validator = Validator::make($request->all(), [
        'subject_id' => 'required',
        'teacher_id' => 'required'
      ]);
      if (!$validator->fails()) {
          try {
              Subjects::where('id','=',$request->subject_id)->update(['leading_teacher' => $request->teacher_id]);
          }
          catch (QueryException $e){
               Session::flash('wrong_data',"$e");
          }
          return redirect()->route('subject_list');
      }
      else {
          Session::flash('wrong_info','There has been problem adding that subject!');
      }
      $teachers = User::select('users.id','users.first_name','users.last_name')->join('roles','users.role_id','=','roles.id')->where('roles.slug','=','teacher')->get();
      $subjects = Subjects::get();
      return view('assign_teacher',['teachers' => $teachers,'subjects' => $subjects]);
  }
  
}
