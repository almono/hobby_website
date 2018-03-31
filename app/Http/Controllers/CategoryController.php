<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use Mockery\Exception;
use Session;
use Validator;
use File;

class CategoryController extends Controller
{


    public function admin_show_categories()
    {
        $categories = Category::get();

        return view('front.admin_view_categories',['categories' => $categories]);
    }

    public function edit_category($id) {
        $category = Category::where('id',$id)->firstOrFail();
        return view('front.admin_edit_category',['category' => $category]);
    }

    public function update_category(Request $request) {

        $input = $request->all();
        $category = Category::findorFail($input['id']);

        if (isset($input['new_name']) && $input['new_name'] != '') {
            $category->name = $input['new_name'];
        }
        try {
            $category->save();
        }
        catch (Exception $e){
            flash()->warning('Wystąpił błąd podczas zapisu :( ');
        }

        flash()->success('Przedmiot zmodyfikowano pomyślnie!');
        return redirect()->route('admin_show_categories');
    }

}
