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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', function ()
{
    //view loginView has to be name of the file in the view
    return view('login');
});

Route::get('/register', function ()
{
    //view loginView has to be name of the file in the view
    return view('register');
});

Route::post('Register', 'UserController@index');

Route::post('login', 'UserController@login');