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
Route::get('/register',['uses' => 'MainpageController@register_form', 'as' => 'register_form']);
Route::post('/register',['uses' => 'UserController@create', 'as' => 'register']);

Route::get('/my_account',['uses' => 'UserController@my_account', 'as' => 'my_account']);
Route::get('/profile/{id?}',['uses' => 'MainpageController@login_form', 'as' => 'login_form']);

Route::get('/admin_login', ['uses' => 'UserController@admin_login', 'as' => 'admin_login']);
Route::get('/admin', ['uses' => 'UserController@admin_panel', 'as' => 'admin_panel']);
