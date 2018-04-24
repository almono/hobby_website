<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/','MainpageController@index');
Route::get('/home', 'MainpageController@index')->name('home');

Route::get('logout', function() {
    Auth::logout();
    return redirect('home');
});

Route::get('/login',['uses' => 'MainpageController@login_form', 'as' => 'login_form']);
Route::post('/login',['uses' => 'MainpageController@login', 'as' => 'login']);

Route::get('/admin_login', ['uses' => 'UserController@admin_login', 'as' => 'admin_login']);
Route::get('/admin', ['uses' => 'UserController@admin_panel', 'as' => 'admin_panel']);

Route::get('/admin/dodaj_przedmiot' , ['uses' => 'ItemController@new_item_view', 'as' => 'admin_new_item']);
Route::post('/admin/dodaj_przedmiot' , ['uses' => 'ItemController@create_new_item', 'as' => 'admin_add_new_item']);

Route::get('/admin/dodaj_kategorie', ['uses' => 'UserController@new_category_view', 'as' => 'admin_new_category']);
Route::post('/admin/dodaj_kategorie', ['uses' => 'UserController@create_new_category', 'as' => 'admin_add_new_category']);

//Route::post('/admin/lista', ['uses' => 'UserController@view_items', 'as' => 'admin_show_items']);
Route::get('/admin/przedmioty_lista', ['uses' => 'ItemController@admin_show_items', 'as' => 'admin_show_items']);
Route::get('/admin/kategorie_lista', ['uses' => 'CategoryController@admin_show_categories', 'as' => 'admin_show_categories']);

Route::post('/admin/usun/{id}', ['uses' => 'UserController@delete_item', 'as' => 'delete_item']);
Route::post('/admin/edytuj_przedmiot/{id}', ['uses' => 'UserController@edit_item', 'as' => 'edit_item']);
Route::post('/admin/edit_item/{id}', ['uses' => 'UserController@update_item', 'as' => 'update_item']);

Route::post('/admin/edytuj_kategorie/{id}', ['uses' => 'CategoryController@edit_category', 'as' => 'edit_category']);
Route::post('/admin/edit_category/{id}', ['uses' => 'CategoryController@update_category', 'as' => 'update_category']);

Route::post('/admin/update_home_category', ['uses' => 'CategoryController@update_homepage_cat', 'as' => 'update_homepage_cat']);

Route::get('/category/{id}', ['uses' => 'ItemController@show_items', 'as' => 'show_items']);