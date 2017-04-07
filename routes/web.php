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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});
Route::get('/test2', function () {
    return view('test2');
});
Route::get('/test2', function () {
    return view('test2');
});
Route::get('/sin', function () {
    return view('sin');
});
Route::get('/cos', function () {
    return view('cos');
});
Route::get('/image', function () {
    return view('image');
});
 Route::get('/img', 'UserController@imgParam');
 Route::post('/img', 'UserController@imgParam');



//Route::post('/reg', 'UserController@create');
//Route::post('/register', 'UserController@create');

Route::group(['prefix' => 'user'], function () {

    Route::get('/home', 'HomeController@index');

    Route::get('/login', 'UserController@showLogin');
    Route::post('/login', 'UserController@postLogin');
    Route::get('/register', 'UserController@showRegister');
    Route::post('/register', 'UserController@postRegister');
    Route::get('/logout', 'UserController@logout');
    Route::post('/logout', 'UserController@logout');
    Route::get('/', 'UserController@showList')->middleware('login')->middleware('role');
    Route::get('/report', 'UserController@showReport');
    //Route::post('/', 'UserController@showList')->middleware('login')->middleware('role');
    Route::get('/reportchart', 'UserController@showReportChart');
    Route::get('/chart/{id}', 'UserController@showUserReportChart');
    Route::get('{id}', 'UserController@showEdit');
    Route::post('{id}', 'UserController@showEdit');
    Route::get('{id}/edit', 'UserController@showEdit');
    Route::post('{id}/edit', 'UserController@postEdit');
    


    
});

    Route::post('/change', 'UserController@postChange');
    Route::get('/change', 'UserController@postChange');




