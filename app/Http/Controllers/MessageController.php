<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use Session;

class MessageController extends Controller
{
    public function MessageForm(Request $request) {
        $users = User::GetAllDifferentUsers(Session::get('user.id'));
        if (null !== $request->input("replying")) {
            return view('message_form',['users' => $users,'replying' => 1, 'topic' => $request->input('topic'), 'user' => $request->input('user'), 'user_id' => $request->input('user_id')]);
        }
        else {
            return view('message_form',['users' => $users]);
        }
    }

    public function Inbox() {
        $user = Session::get('user.id');
        $results = Message::GetMessages($user);
        return view('message_list',['results' => $results]);
    }

    public function SendMessage(Request $request) {
        $message = new Message;
        $message->from = Session::get('user.id');
        $message->to = $request->input('person');
        $message->topic = $request->input('topic');
        $message->content = $request->input('content');
        try {
            $message->save();
        }
        catch (QueryException $e) {
            Session::flash('message','Your message could not be sent!');
        }
        finally {
            $user = Session::get('user.id');
            Session::flash('message','Your message has been sent!');
            $results = Message::GetMessages($user);
            return view('message_list',['results' => $results]);
        }
    }

    public function ViewMessage(Request $request) {
        $message_id = $request->input('message');
        $user_id = $request->input('user');
        $topic = $request->input('topic');
        $results = Message::ShowMessage($message_id);
        Message::where('id','=',$message_id)->update(['status' => 1]);
        return view('message_view',['results' => $results, 'user' => $user_id, 'topic' => $topic]);
    }

    public function DeleteMessage(Request $request) {
        $message_id = $request->input('message');
        $message = Message::where('id','=',$message_id)->first();
        var_dump($message_id);
        $message->delete();
        Session::flash('message','Message was deleted!');
        return redirect()->route('message_list');
    }
}
