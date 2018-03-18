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

Route::get('/login', 'MainController@getLogin')->name('login');
Route::post('/login', 'MainController@postLogin');

Route::get('/register', 'MainController@getRegister')->name('register');
Route::post('/register', 'MainController@postRegister');

Route::get('/password-config', 'MainController@getPasswordConfig')->name('password-config');
Route::post('/password-config', 'MainController@postPasswordConfig')->name('post-password-config');

Route::get('/logout', 'MainController@logout')->name('logout');
Route::get('/home', 'MainController@home')->name('home');
