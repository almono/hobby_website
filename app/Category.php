<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    public static function NewCategory($params) {
        $category = new Category;
        $category->name = $params['nazwa'];
        $category->description = $params['opis'];
        if (isset($params['is_home'])) {
            $category->is_home = '1';
        }
        else {
            $category->is_home = '0';
        }


        try {
            $category->save();
        }
        catch (exception $e) {
            dd($e);
        }

    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

}
