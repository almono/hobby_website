<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\Subjects;
use App\ClassMain;
use Session;
use Validator;

class ClassEditController extends Controller
{
  public function ViewClass(Request $request) {
      $class_id = $request->input("class_id");
      $classes = ClassMain::leftJoin('class_subject','class_subject.class_id','=','class.id')->leftJoin('subjects','subjects.id','=','class_subject.subject_id')->select('subjects.id as subject_id','class.id as class_id','class.name as name','subjects.name as subjects_name')->where('class.id','=',$class_id)->first();
      $subjects = Subjects::get();
      return view('class_edit',['classes' => $classes,'subjects' => $subjects]);
  }

  public function EditClass(Request $request) {
      $validator = Validator::make($request->all(), [
          'new_subject_id' => 'nullable|integer',
          'class_id' => 'nullable|integer'
      ]);
      if (!$validator->fails()) {
          $new_subject = $request->input("new_subject_id");
          $class_id = $request->input("class_id");
          try {
              \DB::table('class_subject')->insert([
                  'class_id' => $class_id,
                  'subject_id' => $new_subject
              ]);
          }
          catch (QueryException $e){
              Session::flash('data',"You entered wrong values!");
          }
          finally {
              return redirect()->route('class_list');
          }
      }
      else {
          Session::flash('data',"The values you entered are incorrect!");
      }
      return redirect()->route('class_list');
  }

  public function DeleteClass(Request $request) {
      $id = $request->input("class_id");
      $class = ClassMain::where('id','=',$id)->first();
      try {
          $class->delete();
      }
      catch (QueryException $e){
          Session::flash('data',"Class could not be deleted, make sure there are no students assigned to it");
          return redirect()->route('class_list');
      }
      Session::flash('data',"Class has been deleted!");
      return redirect()->route('class_list');
  }
}
