<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Subjects extends Model
{
    protected $table = 'subjects';

    public static function TeacherMySubjects() {
      $subjects = array();
      $results = Subjects::select('subjects.name as subject','class.name as class','subjects.id','class.id')->join('class_subject','class_subject.subject_id','=','subjects.id')->join('class','class.id','=','class_subject.class_id')->where('subjects.leading_teacher','=',Session::get('user.id'))->orderBy('subjects.name','asc')->orderBy('class.name','asc')->get();
      foreach($results as $result) {
          if (!isset($subjects[$result->subject])) {
              $subjects[$result->subject] = [];
          }
          $subjects[$result->subject][] = $result->class;
      }
      return $subjects;
    }
}
