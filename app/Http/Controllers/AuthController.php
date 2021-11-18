<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
        } else {
            return response()->json([
                'message' => 'Invalid login details',
            ], 401);
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }

    public function me(Request $request)
    {
        return response()->json([
            'data' => $request->user(),
        ]);
    }

    public function getUsers(Request $request)
    {
        if (Auth::attempt(['email' => 'johndoe@example.com', 'password' => 'password'])) {
            $request->session()->regenerate();
            dd('cool');
        }


        return response()->json([
            'data' => User::all()->toArray(),
        ]);
    }
}
