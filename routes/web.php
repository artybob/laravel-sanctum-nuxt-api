<?php

use Illuminate\Support\Facades\Route;

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

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::post('logout', 'AuthController@logout');

Route::get('/login/{service}', 'SocialLoginController@redirect');
Route::get('/login/{service}/callback', 'SocialLoginController@callback');
