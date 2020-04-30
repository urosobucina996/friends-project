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
Route::post('login','UserController@login');
Route::post('register','UserController@register');
Route::get('allUsers','UserController@allUsers')->middleware('access');

// Invitation Route
Route::middleware(['access'])->group(function () {
    //
    Route::post('invite','InvitationController@invite');
    Route::post('reply','InvitationController@replyToInvitation');
    Route::post('reject','InvitationController@rejectInvitation');
    Route::post('getSent','InvitationController@getSentInvitaion');
    Route::post('getRecived','InvitationController@getRecivedInvitaion');
});


