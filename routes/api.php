<?php

use App\Http\Resources\UserResource;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });

    Route::post('/createUser', 'AdminController@createUser');
    Route::post('/removeUser', 'AdminController@removeUser');
    Route::post('/changeAvatar', 'AdminController@changeAvatar');

    Route::get('/getRoles', 'AdminController@getRoles');
    Route::get('/getUsers', 'AdminController@getUsers');

    Route::get('messages', 'ChatsController@fetchMessages');
    Route::post('messages', 'ChatsController@sendMessage');
});



