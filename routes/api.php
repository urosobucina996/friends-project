<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('allUsers','UserController@allUsers');
// User Route
Route::post('user','UserController@index');
Route::get('allUsers','UserController@allUsers')->middleware('access');

// Invitation Route
Route::post('invite','InvitationController@invite');
Route::post('reply','InvitationController@replyToInvite');
Route::post('getSent','InvitationController@getSentInvitaion');
Route::post('getRecived','InvitationController@getRecivedInvitaion');

