<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UsersRestController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//API routes
Route::get('/jobs', 'UsersRestController@getJobs');
Route::get('/portfolio/{id}', 'UsersRestController@getPortfolio');
Route::get('/job/{id}', 'UsersRestController@getJob');