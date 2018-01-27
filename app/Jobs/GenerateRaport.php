<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Filesystem;
use Carbon;
use App\TeacherLog;
use App\User;
use App\Grades;
use App\Raports;
use Session;


class GenerateRaport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $timeout = 30;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $students = Grades::PrepareRaport();
      $app = base_path();
        
      if (!is_dir("$app\\reports")) {
        mkdir("$app\\reports");
      }

      $mytime = Carbon\Carbon::now();
      $mytime->toDateString();
      $mytime = "test"; // to add temporary windows support
      $raport_path = "$app\\reports";
      $raport_name = $mytime."_".Session::get('user.first_name')."_".Session::get('user.last_name')."_report.csv";
        
      $file = fopen($raport_path . "\\" . $raport_name,'w');
      $export_data="Student,Subject,Grades\n";
      fwrite($file,$export_data);

      foreach($students as $student=>$subjects) {
        $export_data = $student.',';
        foreach($subjects as $subject=>$grades) {
          $export_data .= $subject.',';
          foreach($grades as $grade) {
            $export_data .= $grade." ";
          }
          $export_data .= ',';
        }
        $export_data .= "\n";
        try {
          fwrite($file,$export_data);
        }
        catch (Exception $e) {
          Session::flash('invalid_data','Something went wrong while generating raport!');
        }
      }
      try {
        $raport = new Raports;
        $raport->teacher_id = Session::get('user.id');
        $raport->name = $raport_name;
        $raport->save();
      }
      catch (QueryException $e) {
        Session::flash('invalid_data','There was a problem while generating your raport!');
      }
    }
}
