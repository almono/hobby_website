<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    public static function GetMessages($user_id) {
        $results = Message::select('u2.first_name','u2.last_name','u2.id as user_id','messages.id as message','messages.topic as topic','messages.status')
                ->join('users as u1','messages.to','=','u1.id')
                ->join('users as u2','messages.from','=','u2.id')
                ->where([['messages.to','=',$user_id]])->orderBy('messages.created_at','desc')->paginate(10);
        return $results;
    }

    public static function ShowMessage($message_id) {
        $results = Message::select('users.first_name','users.last_name','messages.id as message','messages.topic as topic','messages.content as content','roles.slug as role')->join('users','users.id','=','messages.from')->join('roles','roles.id','=','users.role_id')->where('messages.id','=',$message_id)->first();
        return $results;
    }
}
