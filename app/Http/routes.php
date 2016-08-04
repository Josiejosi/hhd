<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.

git remote add origin https://github.com/Josiejosi/wallet.git
git push -u origin master
|
*/

Route::get('/', function () {
    return view('front.index');
});

Route::get('/signin', function () {
    return view('front.login');
});

Route::get('/register', function () {
    return view('front.register');
});

Route::get('/contactus', function () {
    return view('front.contactus');
});

