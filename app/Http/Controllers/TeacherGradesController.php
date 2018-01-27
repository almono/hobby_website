<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\EmailController;
use App\Jobs\GenerateRaport;
use App\Subjects;
use App\Grades;
use App\User;
use App\TeacherLog;
use App\Raports;
use App\Emails;
use Session;
use Validator;

class TeacherGradesController extends Controller
{
    public function index() {
        $results = Subjects::select('class.id as class_id','subjects.id as subject_id','subjects.name as subject','class.name as class')->join('class_subject','class_subject.subject_id','=','subjects.id')->join('class','class.id','=','class_subject.class_id')->where([['leading_teacher','=',Session::get('user.id')],['subjects.leading_teacher','=',Session::get('user.id')]])->orderBy('class.name','asc')->orderBy('subjects.name','asc')->get();
        return view('teacher_grades',['results'=>$results]);
    }

    public function MySubjects() {
        $results = Subjects::TeacherMySubjects();
        return view('teacher_my_subjects',['results'=>$results]);
    }

    public function GetStudents() {
        list($subject_id,$class_id) = explode ("|", $_POST['id'],2);
        $results = User::GetStudentsDetailed($subject_id,$class_id);
        return view('teacher_grades_form',['results' => $results,'subject_id' => $subject_id, 'class_id' => $class_id]);
    }

   public function StudentGradeForm(Request $request) {
       $validator = Validator::make($request->all(), [
           'user_id' => 'required|integer',
           'subject_id' => 'required|integer',
           'class_id' => 'required|integer',
           'new_grade' => 'required|integer'
       ]);
       if (!$validator->fails()) {
           $student_id = $request->input('user_id');
           $subject_id = $request->input('subject_id');
           $new_grade = $request->input('new_grade');

           $grade = new Grades;
           $grade->user_id = $student_id;
           $grade->class_id = $request->input('class_id');
           $grade->subject_id = $subject_id;
           $grade->teacher_id = Session::get('user.id');
           $grade->grade = $new_grade;

           $log = new TeacherLog;
           $log->teacher_id = Session::get('user.id');
           $log->action = 'New';
           $log->student_id = $student_id;
           $log->grade = $new_grade;
           $log->subject_id = $subject_id;

           $subject = Subjects::where('id','=',$request->input('subject_id'))->first();
           $subject_name = $subject->name;

           try {
               $grade->save();
               $log->grade_id = $grade->id;
               $log->save();
           }
           catch (QueryException $e){
               Session::flash('invalid_data',"You entered wrong values!" . $request->input('user_id') . " " . $request->input('class_id') . " " . $request->input('subject_id') . " " . $request->input('new_grade'));
               return redirect()->route('teacher_my_grades');
           }
           finally {
               if (Emails::CheckNotification($student_id) == 1) {
                   EmailController::send($student_id,$subject_name,$new_grade);
                   return redirect()->route('teacher_my_grades');
               }
           }
       }
       else {
           Session::flash('invalid_data',"You entered wrong values! user" . $request->input('user_id') . " class " . $request->input('class_id') . " subject " . $request->input('subject_id') . " new " . $request->input('new_grade'));
       }
       return redirect()->route('teacher_my_grades');
    }

    public function DeleteGrade(Request $request) {
        $id = $request->input("grade_id");
        $grade = Grades::where('id','=',$id)->first();
        $date = $grade->created_at;

        $log = new TeacherLog;
        $log->teacher_id = Session::get('user.id');
        $log->action = 'Deleted';
        $log->student_id = $grade->user_id;
        $log->grade = $grade->grade;
        $log->subject_id = $grade->subject_id;

        try {
            $log->save();
            $grade->delete();
        }
        catch (QueryException $e){
            Session::flash('invalid_data',"Something went wrong while deleting this grade!!");
            return redirect()->route('teacher_my_grades');
        }
        return redirect()->route('teacher_my_grades');
    }

    public function ViewGrade(Request $request) {
        $grade_id = $request->input('grade_id');
        $grade = Grades::where('id','=',$grade_id)->first();
        return view('teacher_grade_change',['grade' => $grade]);
    }

    public function ChangeGrade(Request $request) {
        $validator = Validator::make($request->all(), [
            'new_grade' => 'nullable|integer',
            'new_comment' => 'nullable|string'
        ]);
        if (!$validator->fails()) {
            $grade_id = $request->input('grade_id');
            $grade = Grades::where('id','=',$grade_id)->first();
            $new_grade = $request->input('new_grade');
            $new_comment = $request->input('new_comment');

            $log = new TeacherLog;
            $log->teacher_id = Session::get('user.id');
            $log->action = 'Changed';
            $log->student_id = $grade->user_id;
            $log->grade = $grade->grade;
            $log->changedTo = $new_grade;
            $log->grade_id = $grade_id;
            $log->subject_id = $request->input('subject_id');

            if (isset($new_grade)) {
                $grade->grade = $new_grade;
            }
            if (isset ($new_comment)) {
                $grade->comment = $new_comment;
            }
            $grade_date = $grade->created_at;
        }
        try {
            $log->save();
            $grade->save();
        }
        catch (QueryException $e){
            Session::flash('invalid_data',"Grade could not be changed!");
            return redirect()->route('teacher_my_grades');
        }
        finally {
            return redirect()->route('teacher_my_grades');
        }
    }

    public function MyGrades() {
        $mygrades = Grades::DisplayGrades(Session::get('user.id'));
        $results = Grades::TeacherMyGrades(Session::get('user.id'));
        return view('teacher_my_grades',['results'=>$results, 'mygrades' => $mygrades]);
    }

    public function HistoryLog() {
        $results = TeacherLog::GetLogs();
        return view('teacher_history_log',['results'=>$results]);
    }

    public function ListRaports() {
        $results = Raports::where('teacher_id','=',Session::get('user.id'))->orderBy('created_at','desc')->paginate(10);
        return view('teacher_raports_list',['results' => $results]);
    }

    public function GenerateRaport() {
        $this->dispatch(new GenerateRaport(Session::get('user')));
        return redirect()->route('teacher_raports');
    }

    public function GetRaport(Request $request) {
        $app = base_path();
        $raport_path = "$app/reports/";
        $raport_name = $request->input('raport_name');
        return response()->download($raport_path . $raport_name);
    }
}
