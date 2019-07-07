<?php

namespace App\Http\Controllers;


use Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Route;
use App\User;
use App\Item;
use App\Category;
use Mockery\Exception;
use Carbon\Carbon;
use Session;
use Validator;
use File;

class ItemController extends Controller
{

    function __construct() {

        $this->sort = array();
        $this->country = null;
        $this->slug = null;
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
        if (Request::has('sort') && Request::get('sort') == 'custom-slug') {
            $this->slug = Request::get('custom_slug');
        }
        if (Request::has('sort') && Request::get('sort') == 'custom-town') {
            $this->town = Request::get('custom_town');
        }
        if (Request::has('sort') && Request::get('sort') == 'custom-country') {
            $this->country = Request::get('custom_country');
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
            $item_names = Item::groupBy('name')->select('name')->get();
            $categories = Category::get(); //dd($categories);
            return view('front.admin_add_item', ['categories' => $categories, 'item_names' => $item_names]);
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

    public function delete_item($id) {
        $item = Item::find($id);
        try {
            $item->delete();
        }
        catch (exception $e) {
            flash()->warning('Wystąpił błąd podczas usuwania!');
        }

        return back();
    }
// http://localhost/hobby/public/admin/edytuj_przedmiot/465
// http://localhost/hobby/public/admin/edytuj_przedmiot/900
    public function edit_item($id) {
        $item = Item::where('id',$id)->with('category')->first(); //dd(File::exists(storage_path() . "\zdjecia\\" . "test-1000-2.jpg"));
        if(!$item) {
            flash()->warning('Nie ma takiego przedmiotu!');
            return redirect()->route('admin_show_items');
        }
        $item_names = Item::groupBy('name')->select('name')->get();
        $categories = Category::get();
        $previous = url()->previous();
        return view('front.admin_edit_item',['item' => $item, 'categories' => $categories, 'item_names' => $item_names, 'previous' => $previous ]);
    }

    public function update_item(Request $request) {

        $input = Request::all();
        $item = Item::findorFail($input['id']);

        $now = Carbon::now()->timestamp;

        if(isset($input['zdjecie_przod']) && !is_null($input['zdjecie_przod']))
        {
            if(file_exists(public_path() . "\img\\" . $item->img_front))
            {
                unlink(public_path() . "\img\\" . $item->img_front);
            }

            $file1 = str_slug($item->name) . "-" . $item->year . "-" . $item->category_id . "-1" . $now . ".jpg";
            $input['zdjecie_przod']->move(public_path() . "\img\\",$file1);
            $item->img_front = $file1;
        }
        if(isset($input['zdjecie_tyl']) && !is_null($input['zdjecie_tyl']))
        {
            if(file_exists(public_path() . "\img\\" . $item->img_back))
            {
                unlink(public_path() . "\img\\" . $item->img_back);
            }

            $file2 = str_slug($item->name) . "-" . $item->year . "-" . $item->category_id . "-2" . $now . ".jpg";
            $input['zdjecie_tyl']->move(public_path() . "\img\\",$file2);
            $item->img_back = $file2;
        }

        if (isset($input['new_name']) && $input['new_name'] != '') {
            $item->name = $input['new_name'];
            $item->slug = str_slug($input['new_name']);
        }
        if (isset($input['new_city']) && $input['new_city'] != '') {
            $item->city = $input['new_city'];
            $item->city_slug = str_slug($input['new_city']);
        }
        if (isset($input['new_year']) && $input['new_year'] != '') {
            $item->year = $input['new_year'];
        }
        if (isset($input['new_country']) && $input['new_country'] != '') {
            $item->country = $input['new_country'];
        }
        if (isset($input['exchange']) && $input['exchange'] != '') {
            $item->exchange = '1';
        }
        else
        {
            $item->exchange = '0';
        }

        if (isset($input['is_square']) && $input['is_square'] != '') {
            $item->is_square = '1';
        }
        else
        {
            $item->is_square = '0';
        }

        $item->category_id = $input['kategoria'];
        $item->subcategory = $input['new_subcat'];

        $item->img_orient_front = $input['new_orient_front'];
        $item->img_orient_back = $input['new_orient_back'];



        try {
            $item->save();
        }
        catch (Exception $e){
            flash()->warning('Wystąpił błąd podczas zapisu :( ');
        }

        flash()->success('Przedmiot zmodyfikowano pomyślnie!');

        if(isset($input['previous_url']) && !is_null($input['previous_url'])) {
            return redirect()->to($input['previous_url']);
        } else {
            return redirect()->route('admin_show_items');
        }

    }

    public function admin_show_items()
    {
        $items = Item::byFilter($this->sort)
            ->customYear($this->year)
            ->customName($this->name)
            ->customCountry($this->country)
            ->podkategoria($this->subcategory)
            ->orderBy('created_at','DESC')->paginate(40);

        return view('front.admin_view_items',['items' => $items]);
    }

    public function show_items($category = null)
    {
        if ($category != null) {
            $items = Item::byFilter($this->sort)
                ->customYear($this->year)
                ->customName($this->name)
                ->customTown($this->town)
                ->customCountry($this->country)
                ->customSlug($this->slug)
                ->podkategoria($this->subcategory)
                ->customYear2($this->start_year,$this->end_year)->where('category_id','=',$category)->orderBy('year','ASC')->paginate(18);
        }
        else {
            $items = Item::byFilter($this->sort)
                ->customYear($this->year)
                ->customName($this->name)
                ->customTown($this->town)
                ->customCountry($this->country)
                ->customSlug($this->slug)
                ->podkategoria($this->subcategory)
                ->customYear2($this->start_year,$this->end_year)->orderBy('year','ASC')->paginate(18);
        }

        if(isset($category) && !is_null($category)) {
            $cat = Category::where('id',$category)->first();
            $title = $cat['name'];
            $seo = 'Sławek Zaspa - ' . $cat['name'];
        }
        else {
            $title = "Kolekcja";
            $seo = 'Sławek Zaspa - kolekcje';
        }

        if(isset($this->subcategory) && is_null($this->slug)) {
            $seo .= ' - ' . $this->subcategory;
        }
        if(isset($this->slug)) {
            $seo .= ' - ' . $this->slug;
        }

        return view('front.offer_list',['items' => $items, 'category' => $category, 'title' => $title, 'seo' => $seo]);
    }

    public function show_items_name($category,$name)
    {
        $items = Item::where('category_id',$category)->where("slug",$name)->orderBy('year','ASC')->paginate(18);

        if(isset($category) && !is_null($category)) {
            $cat = Category::where('id',$category)->first();
            $title = $cat['name'];
            $seo = 'Sławek Zaspa - ' . $cat['name'];
        }
        else {
            $title = "Kolekcja";
            $seo = 'Sławek Zaspa - kolekcje';
        }

        if(isset($this->subcategory) && is_null($this->slug)) {
            $seo .= ' - ' . $this->subcategory;
        }
        if(isset($this->slug)) {
            $seo .= ' - ' . $this->slug;
        }

        return view('front.offer_list',['items' => $items, 'category' => $category, 'title' => $title, 'seo' => $seo]);
    }

    public function show_new_items()
    {
        $items = Item::orderBy('created_at','DESC')->paginate(18);
        $seo = 'Sławek Zaspa - nowości';

        return view('front.offer_list',['items' => $items, 'title' => 'Nowości', 'seo' => $seo ]);
    }

    public function show_exchange_items(Request $request)
    {
        $input = Request::all();
        if(isset($input['category']) && !is_null($input['category']))
        {
            $items = Item::where('exchange','1')->where('category_id',$input['category'])->orderBy('created_at','DESC')->paginate(18);
        }
        else {
            $items = Item::where('exchange','1')->orderBy('created_at','DESC')->paginate(18);
        }

        $seo = 'Sławek Zaspa - przedmioty do wymiany';

        return view('front.offer_list',['items' => $items, 'title' => 'Do wymiany', 'seo' => $seo ]);
    }

    public function goToItem(Request $request)
    {
        $item_id = Request::input('itemId');
        $item = Item::find($item_id);
        if(isset($item_id) && !is_null($item_id) && $item)
        {
            return redirect()->route('edit_item', ['id' => $item_id]);
        } else {
            flash()->warning('Nie znaleziono takiego przedmiotu');
            return back();
        }

    }
}
