<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public static function register($email, $name, $password = '', $role = 'user', $avatar = 'no-avatar.png')
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'avatar'=> $avatar,
            'password' => bcrypt($password)
        ]);

        $user->assignRole($role);

        //email conf
        event(new Registered($user));

        return ['user' => $user];
    }

    public static function login($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            session()->regenerate();
        } else {
            return response()->json([
                'message' => 'Invalid login details',
            ], 401);
        }
        //if token auth by id else usual
//        if ($token) {
////            $loginRequest = LoginRequest::where('token', $token);
////
////            Auth::loginUsingId($loginRequest->user_id);
//        } else {
//
//            if (Auth::attempt(['email' => $email, 'password' => $password])) {
//                $token = Auth::user()->createToken('name')->accessToken;
//            }
//        }


    }
}
