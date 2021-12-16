<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PassportService
{
    public static function register($email, $name, $password, $role = 'user')
    {

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        $user->assignRole($role);

        return $user->createToken('name')->accessToken ?? '';
    }

    public static function login($email, $password, $token = '')
    {
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

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $token = Auth::user()->createToken('name')->accessToken;
        }

        return $token;
    }
}
