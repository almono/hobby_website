<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';


    public static function NewItem($params) {
        //dd($params);
        $item = new Item;
        $item->name = $params['nazwa'];
        $item->slug = str_slug($params['nazwa']);
        $item->city = $params['miasto'];
        $item->city_slug = str_slug($params['miasto']);
        $item->year = $params['rok'];
        $item->category_id = $params['kategoria'];
        $item->subcategory = $params['podkategoria'];

        $file1 = str_slug($params['nazwa']) . "-" . $params['rok'] . "-" . $params['kategoria'] . "-1" . ".jpg";
        $file2 = str_slug($params['nazwa']) . "-" . $params['rok'] . "-" . $params['kategoria'] . "-2" . ".jpg";

        $item->img_orient = $params['zdjecie_orientacja'];

        $item->img_front = $file1;
        $item->img_back = $file2;

        $params['zdjecie_przod']->move(public_path() . "\img\\",$file1);
        $params['zdjecie_tyl']->move(public_path() . "\img\\",$file2);

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
            $query->where('name','like','%'. str_slug($sort) .'%');
        }

        return $query;

    }

    public static function scopeCustomTown($query, $sort) {

        if($sort) {
            $query->where('city_slug','like','%' . str_slug($sort) . '%');
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

}
