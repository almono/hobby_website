<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subjects;
use App\Grades;
use App\Emails;
use App\User;
use Session;
use Validator;

class StudentController extends Controller
{
    public function MyGrades() {
        $student_id = Session::get('user.id');
        $results = Grades::StudentMyGrades($student_id);
        return view('student_my_grades',['results' => $results]);
    }

    public function Notifications() {
        return view('student_notifications');
    }

    public function EnableNotification(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|E-Mail',
        ]);
        if (!$validator->fails()) {

            $logged_user = Session::get('user.id');
            $mail = $request->input('email');

            if (Emails::CheckNotification($logged_user) == 1) {
                $email_notif = Emails::where('user_id','=',$logged_user)->first();
                $email_notif->status = 1;
            }
            else {
                $email_notif = new Emails;
                $email_notif->user_id = $logged_user;
                $email_notif->status = 1;
            }

            $user = User::where('id','=',$logged_user)->first();
            $user->email = $mail;
            Session::flash('message','You have enabled the notifications!');

            try {
                $email_notif->save();
                $user->save();
            }
            catch (QueryException $e) {
                Session::flash('message','There has been problem connecting with the database');
            }
      }
      else {
          Session::flash('message','There has been problem enabling your notifications. Make sure you provided correct email address');
      }

      return redirect()->route('student_mail');
    }
}
