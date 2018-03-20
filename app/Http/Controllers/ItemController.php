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

class ItemController extends Controller
{

    protected function show_items($id)
    {
        $items = Item::where('category_id',$id)->paginate(6);

        return view('front.offer_list',['items' => $items]);
    }

}
