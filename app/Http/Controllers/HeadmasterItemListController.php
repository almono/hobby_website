<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Subjects;
use App\ClassMain;
use Session;

class HeadmasterItemListController extends Controller
{
  public function UserListIndex() {
      $results = User::join('roles', 'roles.id', '=', 'users.role_id')->select('users.id','users.username','users.first_name','users.last_name','roles.name as role')->where('users.id','<>',session('user.id'))->orderBy('roles.id','asc')->orderBy('users.last_name','asc')->paginate(10);
      return view('users_list',['results' => $results]);
  }

  public function SubjectsListIndex() {
      $results = Subjects::join('users', 'subjects.leading_teacher', '=', 'users.id')->select('subjects.id as id','subjects.name as subject','users.first_name','users.last_name')->orderBy('subjects.name','asc')->paginate(10);
      return view('subjects_list',['results' => $results]);
  }

  public function ClassListIndex() {
      $results = ClassMain::leftJoin('class_subject','class.id','=','class_subject.class_id')->leftJoin('subjects','class_subject.subject_id','=','subjects.id')->select('class.id as id','class.name','subjects.name as subjects_name')->orderBy('class.name','asc')->orderBy('subjects.name','asc')->paginate(10);
      return view('class_list',['results' => $results]);
  }
}
