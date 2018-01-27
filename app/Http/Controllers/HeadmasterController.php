<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database;
use App\Subjects;
use App\ClassMain;
use App\Grades;
use Session;
use Validator;

class HeadmasterController extends Controller
{
  public function ListAll() {
      $results = Subjects::select('class.id as class_id','subjects.id as subject_id','subjects.name as subject','class.name as class')->join('class_subject','class_subject.subject_id','=','subjects.id')->join('class','class.id','=','class_subject.class_id')->orderBy('class.name','asc')->orderBy('subjects.name','asc')->get();
      return view('hdm_grades_view_form',['results'=>$results]);
  }

  public function ViewGrades() {
      $view = [];
      list($subject_id,$class_id) = explode ("|", $_POST['id'],2);
      $results = Grades::select('user_id','grades.grade as grade','users.first_name as first','users.last_name as last')->join('users','users.id','=','grades.user_id')->where([['grades.subject_id','=',$subject_id],['grades.class_id','=',$class_id]])->get();
      foreach($results as $result) {
          if (!isset($view[$result->last])) {
              $view[$result->last] = [];
          }
          $view[$result->last][] = $result->grade;
      }
      return view('hdm_grades_view',['results' => $view]);
  }

  public function TeacherStatistics() {
      $results = Grades::select('users.first_name as teacher_first','users.last_name as teacher_last' , \DB::raw('COUNT(*) AS Total'))->join('users','users.id','=','grades.teacher_id')->groupBy('teacher_id')->get();

      $lava = new \Khill\Lavacharts\Lavacharts;
      $stats = \Lava::DataTable();
      $stats->addStringColumn('Teacher')
            ->addNumberColumn('Number of grades');
      foreach ($results as $result) {
          $stats->addRow([$result->teacher_first . " " . $result->teacher_last , $result->Total]);
      }
      $chart = \Lava::PieChart('statistics',$stats, ['backgroundColor' => '#d3e1c1']);

      return view('hdm_statistics_view',['results' => $results, 'option' => 1]);
  }

  public function SubjectStatistics() {
      $results = Grades::select('subjects.name as subject' , \DB::raw('COUNT(*) AS Total'))->join('subjects','subjects.id','=','grades.subject_id')->groupBy('subject_id')->get();

      $lava = new \Khill\Lavacharts\Lavacharts;
      $stats = \Lava::DataTable();
      $stats->addStringColumn('Subject')
            ->addNumberColumn('Number of grades');
      foreach ($results as $result) {
          $stats->addRow([$result->subject , $result->Total]);
      }
      $chart = \Lava::PieChart('statistics',$stats, ['backgroundColor' => '#d3e1c1']);

      return view('hdm_statistics_view',['results' => $results, 'option' => 2]);
  }

  public function ClassStatistics() {
      $results = ClassMain::select('class.name as class' , \DB::raw('COUNT(*) AS Total'))->join('users','users.class_id','=','class.id')->groupBy('class_id')->get();
      $lava = new \Khill\Lavacharts\Lavacharts;
      $stats = \Lava::DataTable();
      $stats->addStringColumn('Class')
            ->addNumberColumn('Number of students');
      foreach ($results as $result) {
          $stats->addRow([$result->class , $result->Total]);
      }
      $chart = \Lava::PieChart('statistics',$stats, ['backgroundColor' => '#d3e1c1']);

      return view('hdm_statistics_view',['results' => $results, 'option' => 3]);
  }

}
