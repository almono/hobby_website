<?php

namespace App\Http\Controllers;

use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainpageController extends Controller
{
  public function index() {
      flash('You are now logged in!');
      return view('strona-glowna');
  }

    public function login_form() {
        flash('You are now logged in!');
        return redirect('/admin');
    }

    public function register_form() {
        return view('auth.register');
    }

    public function login(Request $request) {

      $email = $request->input('email');
      $password = $request->input('password');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            flash()->success("Zalogowano poprawnie :)");
            return redirect()->route('admin_panel');
        }
        else {
            flash()->warning("Błąd logowania :( Sprawdź login i hasło");
        }
    }

}
