<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    protected $table = 'emailNotifications';

    public static function CheckNotification($user_id) {
      $count = Emails::where([['user_id','=',$user_id],['status','=',1]])->count();
      if ($count > 0) {
        return 1;
      }
      else {
        return 0;
      }
    }
}
