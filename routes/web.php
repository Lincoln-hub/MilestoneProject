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


Route::get('logout','UserController@logout');

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


Route::get('viewJobs','AdminController@searchAllJob');
Route::get('toJobs','AdminController@findAllJob');
Route::get('portfolio','UserController@findPortfolio');
Route::post('port','UserController@Portfolio');
Route::post('viewGroup','UserController@viewGroup');
Route::post('addToGroup','UserController@addToGroup');
Route::post('removeFromGroup','UserController@removeFromGroup');

Route::get('groups','AdminController@findAllGroups');
Route::post('createGroup','AdminController@createGroup');
Route::post('deleteGroup','AdminController@deleteGroup');
Route::post('editGroup','AdminController@updateGroupView');
Route::post('editTheGroup','AdminController@updateGroup');
Route::post('searchJob','UserController@searchJob');
Route::get('searchJob','UserController@jobDetails');

Route::get('jobDetails','UserController@jobDetails');
Route::post('jobDetails','UserController@jobDetails');

//API routes 
Route::resource('/usersrest', 'UsersRestController');

Route::get('/usersrest', 'UsersRestController@getJobs');

Route::get('/usersrest/{id}', 'UsersRestController@getPortfolio');

//Route::get('users',[UsersRestController::class],'getUsers');


