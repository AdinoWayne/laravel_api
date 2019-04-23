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

Route::get('/', function () {	
    return view('welcome');
});

Route::get('/testing', function () {
	return "hello world";
});

Route::group(['prefix' => 'api/v1','middleware'=>'api'], function() {
    Route::resource('user', 'UserController');
    Route::resource('owner', 'api\OwnerController')->except(['create', 'edit']);
    // Route::resource('owner', 'api\OwnerController')->except(['create', 'edit'])->middleware('owner');
    Route::resource('items', 'api\ItemsController')->except(['create', 'edit']);
});

Route::post('/register', 'api\RegisterController@register');
Route::post('/login', 'api\RegisterController@login');