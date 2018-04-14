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
        $this->name = null;
        $this->subcategory = null;
        $this->start_year = null;
        $this->end_year = null;

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
        if (Request::has('sort') && Request::get('sort') == 'custom-name') {
            $this->name = Request::get('custom_name');
        }
        if (Request::has('sort') && Request::get('sort') == 'custom-town') {
            $this->town = Request::get('custom_town');
        }
        if (Request::has('sort_subcategory') && Request::get('sort_subcategory') == 'Kolej' || Request::get('sort_subcategory') == 'Miejska') {
            $this->subcategory = Request::get('sort_subcategory');
        }
        if (Request::has('start_year')) {
            $this->start_year = Request::get('start_year');
        }
        if (Request::has('end_year')) {
            $this->end_year = Request::get('end_year');
        }
        //dd( );
        //dd( Request::get('producent'));
    }

    public function new_item_view() {
        if (Auth::check()) {
            $categories = Category::get(); //dd($categories);
            return view('front.admin_add_item', ['categories' => $categories]);
        }
        else {
            return redirect('home');
        }
    }

    public function create_new_item() {
        try {
            $params = Request::all();
            Item::NewItem($params);
            flash()->success('Nowy przedmiot został stworzony!');
        }
        catch (exception $e) {
            dd($e);
            flash()->warning('Nie udało się stworzyć nowego przedmiotu :(');
        }

        return back();

    }

    public function admin_show_items()
    {
        $items = Item::byFilter($this->sort)->customYear($this->year)->customName($this->name)->customTown($this->town)->podkategoria($this->subcategory)->get();

        return view('front.admin_view_items',['items' => $items]);
    }

    public function show_items($category = null)
    {
        if ($category != null) {
            $items = Item::byFilter($this->sort)
                ->customYear($this->year)
                ->customName($this->name)
                ->customTown($this->town)
                ->podkategoria($this->subcategory)
                ->customYear2($this->start_year,$this->end_year)->where('category_id','=',$category)->paginate(9);
        }
        else {
            $items = Item::byFilter($this->sort)
                ->customYear($this->year)
                ->customName($this->name)
                ->customTown($this->town)
                ->podkategoria($this->subcategory)
                ->customYear2($this->start_year,$this->end_year)->paginate(9);
        }
        return view('front.offer_list',['items' => $items, 'category' => $category]);
    }

}
