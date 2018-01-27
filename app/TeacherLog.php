<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Session;

class TeacherLog extends Model
{
    protected $table = 'teacher_logs';

    public static function GetLogs() {
        return DB::table('teacher_logs')->select('teacher_logs.id as id','class.id','subjects.id','users.first_name as first','users.last_name as last','class.name as class','subjects.name as subject','teacher_logs.action as action','teacher_logs.grade as grade','teacher_logs.changedTo','teacher_logs.id as id')->join('users','teacher_logs.student_id','=','users.id')->join('class','class.id','=','users.class_id')->join('subjects','subjects.id','=','teacher_logs.subject_id')->where('teacher_logs.teacher_id','=',Session::get('user.id'))->orderBy('teacher_logs.id','desc')->paginate(10);
    }

}
