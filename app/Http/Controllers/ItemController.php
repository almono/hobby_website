<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Item;
use App\Category;
use Mockery\Exception;
use Session;
use Validator;
use File;

class ItemController extends Controller
{

    function __construct() {

        $this->sort = array();
        $this->year = null;
        $this->town = null;

        // '/([0-9]+);([0-9]+)/' do przedzialow

        //Czy istnieje get z zabezpieczeniem
        if (Request::has('sort') && (Request::get('sort') == 'nazwa-asc' || Request::get('sort') == 'nazwa-desc' || Request::get('sort') == 'rocznik-asc' || Request::get('sort') == 'rocznik-desc')) {
            $sort = str_replace("nazwa", "name", Request::get('sort'));
            $sort = str_replace("rocznik", "year", $sort);
            $this->sort = explode("-", $sort);
        }
        if (Request::has('sort') && Request::get('sort') == 'custom-year') {
            $this->year = Request::get('custom_year');
        }
        if (Request::has('sort') && Request::get('sort') == 'custom-town') {
            $this->town = Request::get('custom_town');
        }
        //dd( );
        //dd( Request::get('producent'));
    }

    public function admin_show_items()
    {
        $items = Item::byFilter($this->sort)->customYear($this->year)->customTown($this->town)->paginate(6);

        return view('front.admin_view_items',['items' => $items]);
    }

    public function show_items()
    {

        $items = Item::byFilter($this->sort)->customYear($this->year)->customTown($this->town)->paginate(6);

        return view('front.offer_list',['items' => $items]);
    }

}
