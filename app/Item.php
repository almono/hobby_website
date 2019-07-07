<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Item extends Model
{
    protected $table = 'item';


    public static function NewItem($params) {
        //dd($params);
        $item = new Item;
        $item->name = $params['nazwa'];
        $item->slug = str_slug($params['nazwa']);
        $item->country = $params['panstwo'];
        //$item->city = $params['miasto'];
        //$item->city_slug = str_slug($params['miasto']);
        $item->year = $params['rok'];
        $item->category_id = $params['kategoria'];
        $item->subcategory = $params['podkategoria'];
        $item->is_square = $params['is_square'];

        if(isset($params['exchange']) && !is_null($params['exchange']))
        {
            $item->exchange = 1;
        }
        else
        {
            $item->exchange = 0;
        }

        $now = Carbon::now()->timestamp;

        $file1 = str_slug($params['nazwa']) . "-" . $params['rok'] . "-" . $params['kategoria'] . "-1" . $now . ".jpg";

        $item->img_orient_front = $params['zdjecie_orientacja_front'];
        $item->img_orient_back = $params['zdjecie_orientacja_back'];

        $item->img_front = $file1;

        $params['zdjecie_przod']->move(public_path() . "\img\\",$file1);

        if(isset($params['zdjecie_tyl']) && !is_null($params['zdjecie_tyl']))
        {
            $file2 = str_slug($params['nazwa']) . "-" . $params['rok'] . "-" . $params['kategoria'] . "-2" . $now . ".jpg";
            $params['zdjecie_tyl']->move(public_path() . "\img\\",$file2);
            $item->img_back = $file2;
        }

        try {
            $item->save();
        }
        catch (exception $e) {
            dd($e);
        }

    }

    public static function GetItems($rocznik = '', $kategoria = '') {

        $items = Item::with('category')->paginate(15);
        return $items;

    }

    public function category()
    {
        return $this->hasOne('App\Category', 'id','category_id');
    }


    public static function scopeByFilter($query, $sort) {

        if($sort) {
            $query->orderBy($sort[0],$sort[1]);
        }

        return $query;

    }

    public static function scopeCustomYear($query, $sort) {

        if($sort) {
            $query->where('year',$sort);
        }

        return $query;

    }

    public static function scopeCustomName($query, $sort) {

        if($sort) {
            $query->where('slug','like','%'. str_slug($sort) .'%');
            $query->orderBy('year','ASC');
        }

        return $query;

    }

    public static function scopeCustomSlug($query, $sort) {

        if($sort) {
            $query->where('slug', str_slug($sort) );
            $query->orderBy('year','ASC');
        }

        return $query;

    }

    public static function scopeCustomTown($query, $sort) {

        if($sort) {
            $query->where('city_slug','like','%' . str_slug($sort) . '%');
        }

        return $query;

    }

    public static function scopeCustomCountry($query, $sort) {
        if($sort) {
            $query->where('country','=',$sort);
        }

        return $query;

    }

    public static function scopePodkategoria($query, $sort) {

        if($sort) {
            $query->where('subcategory','like','%' . str_slug($sort) . '%');
        }
        return $query;
    }

    public static function scopeCustomYear2($query, $sort1, $sort2) {

        if($sort1 || $sort2) {
            $query->whereBetween('year', [$sort1, $sort2]);
        }

        return $query;

    }

    public function countItems($name) {
        return Item::where("name",$name)->count();
    }

}
