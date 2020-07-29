<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application Admin panel.
|
| This routes prefix by => admin/
|
| This routes name start by => admin.
*/

Route::group(['middleware' => 'guest:admin', 'namespace' => 'Auth'], function() {

    //show login form
    Route::get('/login', 'LoginController@showLoginForm')->name('login.show-login-form');

    //login
    Route::post('/login', 'LoginController@login')->name('login.login');
});

Route::group(['middleware' => 'auth:admin'], function () {

    //admin panel index
    Route::view('/', 'admin.index')->name('index');

    //admin logout
    Route::get('/logout', 'Auth\LoginController@logout')->name('login.logout');

    //category CRUD
    Route::resource('category', 'CategoryController');

    //tag CRUD
    Route::resource('tag', 'TagController');

    //post CRUD
    Route::resource('post', 'PostController');
});
