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

Route::get('login',array('as'=>'login',function()
    {
            return view('login/login');
     }
));

Route::get('register',array('as'=>'register',function()
    {
            return view('register/register');
     }
));
