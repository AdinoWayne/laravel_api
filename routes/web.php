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
// Auth::routes(['verify' => true]);

Route::get('/', function () {return view('welcome');});

Route::resource('api/v1/user', 'api\UserController');

Route::group(['prefix' => 'api/v1','middleware'=>'owner'], function() {
    Route::resource('owner', 'api\OwnerController')->except(['create', 'edit']);
    Route::resource('items', 'api\ItemsController')->except(['create', 'edit']);
});

Route::post('register', 'api\OwnerController@register');
Route::post('/login', 'api\OwnerController@authenticate');
