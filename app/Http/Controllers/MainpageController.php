<?php

namespace App\Http\Controllers;

use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;

class MainpageController extends Controller
{
  public function index() {

      $items_pl_kolej = Item::where("category_id","1")->where('subcategory','Kolej')->groupBy('name')->get();
      $items_pl_komunikacja = Item::where("category_id","1")->where('subcategory','Komunikacja miejska')->groupBy('name')->get();
      $items_other_groups = Item::where("category_id","2")->groupBy('name')->get();
      $items_other_coutries = \DB::table('item')->selectRaw('country, count(*) as total')->where('country','!=','')->groupBy('country')->get(); //dd($items_other_coutries);
      //$items_other_coutries = Item::where("category_id","2")->where("country","!=","")->groupBy("country")->get(); dd($items_other_coutries);

      return view('strona-glowna',['items_pl_kolej' => $items_pl_kolej, 'items_pl_komunikacja' => $items_pl_komunikacja, 'items_other' => $items_other_groups, 'items_countries' => $items_other_coutries]);
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
