<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\emailNotification;
use App\User;

class EmailController extends Controller
{
    public static function send($student,$subject_name,$grade) {
        $title = "Laravelos grade notification";
        $content = "You received this email because you told us to inform you about your new grades!";

        $user = User::where('id','=',$student)->first();
        $destination = $user->email;

        Mail::to($destination)->send(new emailNotification($title,$content,$subject_name,$grade));
        //return response()->json(['message' => 'Request completed']);
    }
}
