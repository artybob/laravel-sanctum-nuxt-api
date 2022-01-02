<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        AuthService::login($request->email, $request->password);
    }

    public function register(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = AuthService::register($request->email, $request->name, $request->password, $request->role);

        //send thanks mail
        $details = [
            'title' => 'Hello ' .$request->name,
            'body' => 'Thanks for register'
        ];

        if($request->email) {
            \Illuminate\Support\Facades\Mail::to($request->email)->send(new \App\Mail\NewUser($details));
        }
        return $user;

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
    // $loginUrl = env('CLIENT_BASE_URL', 'http://localhost:3000') . '/login?status= ';

}
