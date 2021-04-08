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
//rotta per homepage
/*Route::get('/', function () {
    return view('pages.homepage');
});*/
Auth::routes();
//avendo creato il controller delle pages, richiamiamo la home
Route::get('/','PagesController@home');
//Route::get('/user/{id}','auth.LoginController@show');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

//route per user
//Route::resources(['user','userController']);
//Route::get('user','userController@index');
Route::get('user', 'UserController@show')->name('homeuser')->middleware('auth');


Route::get('caseType','caseTypeController@index')->name('casetype')->middleware('auth');
Route::get('caseType/{id}','caseTypeController@show')->name('casetypeshow/{id}')->middleware('auth');
Route::get('newCase','caseController@index')->name('newcase');

Route::post('upload','imgController@upload')->name('upload');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
