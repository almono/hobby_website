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
        $category->is_home = $params['is_home'];

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

}
