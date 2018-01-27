<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Session;

class Grades extends Model
{
    protected $table = 'grades';

    public static function TeacherGrades($userId = null) {
        return DB::table('grades')->select('users.first_name as first','users.last_name as last','grades.grade as grade','grades.teacher_id','grades.id as grade_id','subjects.name as subject_name','class.name as class')->join('users','users.id','=','grades.user_id')->join('subjects','grades.subject_id','=','subjects.id')->join('class','grades.class_id','=','class.id')->where([['grades.teacher_id','=',Session::get('user.id')]])->orderBy('class.name','asc')->orderBy('subjects.name','asc')->orderBy('users.last_name','asc')->orderBy('grades.created_at','desc')->get();
    }

    public static function TeacherMyGrades($userId = null) {
        return DB::table('grades')->select('users.first_name as first','users.last_name as last','grades.grade as grade','grades.teacher_id','grades.id as grade_id','grades.comment as comment','subjects.name as subject_name','class.name as class')->join('users','users.id','=','grades.user_id')->join('subjects','grades.subject_id','=','subjects.id')->join('class','grades.class_id','=','class.id')->where([['grades.teacher_id','=',Session::get('user.id')]])->orderBy('class.name','asc')->orderBy('subjects.name','asc')->orderBy('users.last_name','asc')->orderBy('grades.created_at','desc')->get();
    }

    public static function DisplayGrades() {
        $mygrades = [];
        $results = Grades::TeacherMyGrades();
        foreach($results as $result) {
            if (!isset($mygrades[$result->class])) {
                $mygrades[$result->class] = [];
            }
            if (!isset($mygrades[$result->class][$result->subject_name])) {
                $mygrades[$result->class][$result->subject_name] = [];
            }
            if (!isset($mygrades[$result->class][$result->subject_name][$result->last])) {
                $mygrades[$result->class][$result->subject_name][$result->last] = [];
            }
            if (!isset($mygrades[$result->class][$result->subject_name][$result->last][$result->grade_id])) {
                $mygrades[$result->class][$result->subject_name][$result->last][$result->grade_id] = [];
            }
            $mygrades[$result->class][$result->subject_name][$result->last][$result->grade_id][] = $result->grade;
            $mygrades[$result->class][$result->subject_name][$result->last][$result->grade_id][] = $result->comment;
        }
        //var_dump($mygrades[$result->class][$result->subject_name][$result->last][$result->grade_id]);
        return $mygrades;
    }

    public static function PrepareRaport() {
        $student = [];
        $grades = Grades::TeacherGrades();
        foreach($grades as $key){
            if (!isset($student[$key->first])) {
                $student[$key->first] = [];
            }
            if (!isset($student[$key->first][$key->subject_name])) {
                $student[$key->first][$key->subject_name] = [];
            }
            $student[$key->first][$key->subject_name][] = $key->grade;
        }
      //var_dump($student);
        return $student;
    }

    public static function StudentMyGrades($student_id) {
        $grades = [];
        $results = Grades::select('subjects.name as subject','grades.grade as grade')->join('subjects','grades.subject_id','=','subjects.id')->where('user_id','=',$student_id)->get();
        foreach($results as $result) {
            if (!isset($grades[$result->subject])) {
                $grades[$result->subject] = [];
            }
            $grades[$result->subject][] = $result->grade;
        }
        return $grades;
    }
}
