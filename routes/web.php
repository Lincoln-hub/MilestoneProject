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
    return view('login');
});

Route::get('logout', function () {
        return view('login');
    });

Route::get('reg', function () {
        return view('register');
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

//Admin routes
Route::get('users','AdminController@ManageUsers');

Route::post('deleteUser','AdminController@deleteUser');

Route::post('suspendUser','AdminController@suspendUser');

Route::get('userProfile','AdminController@viewUser');
Route::post('userProfile','AdminController@viewUser');

Route::post('addJob','AdminController@JobOpening');
Route::get('jobs','AdminController@findAllJobs');
Route::post('edit','AdminController@updateJob');
Route::post('editJob','AdminController@updateTheJob');
Route::post('deleteJob','AdminController@deleteJob');


Route::get('viewJobs','AdminController@findAllJob');
Route::get('toJobs','AdminController@findAllJob');
Route::get('portfolio','UserController@findPortfolio');
Route::post('port','UserController@Portfolio');



