<?php

use App\Http\Controllers\VerifyEmailController;
use App\Http\Resources\UserResource;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });

    Route::post('/createUser', 'AdminController@createUser')->middleware('verified');
    Route::post('/removeUser', 'AdminController@removeUser');
    Route::post('/changeAvatar', 'AdminController@changeAvatar');

    Route::get('/getRoles', 'AdminController@getRoles');
    Route::get('/getUsers', 'AdminController@getUsers');
    Route::post('messages', 'ChatsController@sendMessage');
});

Route::get('messages', 'ChatsController@fetchMessages');

Route::get('/login/{service}', 'SocialLoginController@redirect');
Route::get('/login/{service}/callback', 'SocialLoginController@callback');

Route::prefix('streams')->group(function () {
    Route::get('data', 'StreamsController@getAllStreamsData');
});

//email verification
// Resend link to verify email
Route::post('/email/verify/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
})->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');

// Verify email
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

