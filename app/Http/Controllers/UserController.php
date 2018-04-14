<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Item;
use App\Category;
use Mockery\Exception;
use Session;
use Validator;
use File;

class UserController extends Controller
{

    protected function create(Request $request)
    {
        $data = $request->all(); //dd($data);
        $user = new User;

        $user->username = $data['username'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->gender = $data['gender'];
        $user->city = $data['city'];
        $user->zip_code = $data['zip_code'];
        $user->address = $data['address'];
        $user->phone_number = $data['phone'];
        $user->active = '1';

        $user->save();

        return redirect()->route('home');
    }

    public function my_account() {

        $user_id = User::UserID();
        $user = User::find($user_id);

        return view('front.my_account',['user' => $user]);

    }

    public function admin_login() {
        if (Auth::check()) {
            return redirect('/admin');
        }
        else {
            return view('front.admin_login');
        }
    }

    public function admin_panel() {
        if (!Auth::check()) {
            return redirect('/admin_login');
        }
        else {
            $categories = Category::get();
            $items = Item::get();
            return view('front.admin',['categories' => $categories, 'items' => $items]);
        }
    }

    public function new_category_view() {
        if (Auth::check()) {
            return view('front.admin_add_category');
        }
        else {
            return redirect('home');
        }
    }

    public function create_new_category(Request $request) {
        try {
            $params = $request->all();
            Category::NewCategory($params);
            flash()->success('Nowa kategoria została stworzona!');
        }
        catch (exception $e){
            dd($e);
            flash()->warning('Nie udało się stworzyć nowej kategorii :(');
        }

        return back();

    }

    public function view_items() {
        $items = Item::GetItems();
        return view('front.admin_view_items', ['items' => $items]);
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

    public function edit_item($id) {
        $item = Item::where('id',$id)->with('category')->firstOrFail(); //dd(File::exists(storage_path() . "\zdjecia\\" . "test-1000-2.jpg"));
        $categories = Category::get();
        return view('front.admin_edit_item',['item' => $item, 'categories' => $categories]);
    }

    public function update_item(Request $request) {

        $input = $request->all();
        $item = Item::findorFail($input['id']);

        if (isset($input['new_name']) && $input['new_name'] != '') {
            $item->name = $input['new_name'];
        }
        if (isset($input['new_city']) && $input['new_city'] != '') {
            $item->city = $input['new_city'];
            $item->city_slug = str_slug($input['new_city']);
        }
        if (isset($input['new_year']) && $input['new_year'] != '') {
            $item->year = $input['new_year'];
        }
        $item->category_id = $input['kategoria'];
        $item->subcategory = $input['new_subcat'];
        try {
            $item->save();
        }
        catch (Exception $e){
            flash()->warning('Wystąpił błąd podczas zapisu :( ');
        }

        flash()->success('Przedmiot zmodyfikowano pomyślnie!');
        return redirect()->route('admin_show_items');
    }

}
