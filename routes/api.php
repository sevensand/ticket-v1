<?php

use Illuminate\Http\Request;

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


Route::group(['middleware' => 'cors', 'prefix' => '/v1'], function () {
    Route::post('/login', 'UserController@authenticate');
    Route::post('/register', 'UserController@register');
    Route::get('/logout/{api_token}', 'UserController@logout');

    Route::post('/update', 'UserController@update');



    Route::post('/postannouncement', 'AnnouncementController@announcementpost');
    Route::get('/announcementlist', 'AnnouncementController@announcementlist');


    Route::post('/messageto', 'MessagesController@messagespost');
    Route::get('/messagelist', 'MessagesController@messagelist');


    Route::post('/userinfo', 'UserinfoController@getuserinfo');
    Route::post('/validate', 'UserinfoController@validateEmployeeid');


    Route::get('/confirmationticket/{employeeid}', 'Confirmation@getConfirmationticket');

    Route::get('/Userlist', 'AdminController@Userlist');


    Route::post('/Uploadticket', 'AdminController@Upcticket');
});


Route::middleware('jwt.auth')->get('users', function(Request $request) {
    return auth()->user();
});
