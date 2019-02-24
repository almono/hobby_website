<?php

namespace App\Http\Controllers;

use Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Item;

class MainpageController extends Controller
{
  public function index() {

      $items_pl_kolej = Item::where("category_id","1")->where('subcategory','Kolej')->groupBy('name')->get();
      $items_pl_komunikacja = Item::where("category_id","1")->where('subcategory','Komunikacja miejska')->groupBy('name')->get();
      $items_other_groups_kolej = Item::where("category_id","2")->where('subcategory','Kolej')->groupBy('name')->get();
      $items_other_groups_komunikacja = Item::where("category_id","2")->where('subcategory','Komunikacja miejska')->groupBy('name')->get();
      $items_other_coutries = \DB::table('item')->selectRaw('country, count(*) as total')->where('country','!=','')->groupBy('country')->get();
      //$items_other_coutries = Item::where("category_id","2")->where("country","!=","")->groupBy("country")->get(); dd($items_other_coutries);

      $calendars_pl = Item::where('category_id','1')->count();
      $calendars_other = Item::where('category_id','2')->count();

      return view('strona-glowna',
          ['items_pl_kolej' => $items_pl_kolej, 'items_pl_komunikacja' => $items_pl_komunikacja,
              'items_other_groups_kolej' => $items_other_groups_kolej, 'items_other_groups_komunikacja' => $items_other_groups_komunikacja,
              'items_countries' => $items_other_coutries,
              'calendars_pl' => $calendars_pl,
              'calendars_other' => $calendars_other
          ]);
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

        return false;
    }

    public function minifyImages() {

        $key = env("TINIFY_KEY", NULL);
        \Tinify\setKey($key);

        if(!is_null($key) && isset($key))
        {
            $dir = \File::files('img');
            foreach($dir as $key => $file)
            {
                $path = public_path() . "\\" . $file;

                try {
                    $source = \Tinify\fromFile($path);
                    $source->toFile($path);
                }
                catch(\Exception $e) {
                    Log::info("TinyPNG compression error for " . $path);
                    Log::info($e->getMessage());
                }
            }
        }
        else {
            Log::info("TinyPNG key error!");
            dd("There has been a problem with your TinyPNG key!");
        }
    }

}
