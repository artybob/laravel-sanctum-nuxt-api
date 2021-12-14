<?php

namespace App\Http\Controllers;

use App\Services\PassportService as Ps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassportController extends Controller
{

    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $token = Ps::register($request->email, $request->name, $request->password);

        return $this->apiAuthResponse($token);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $token = Ps::login($request->email, $request->password);

        return $this->apiAuthResponse($token);
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
//    public function details()
//    {
//        return response()->json(['user' => auth()->user()], 200);
//    }

    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();

        return response()->json(['status' => 'logged out']);
    }

    private function apiAuthResponse($token)
    {
        if ($token) {
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }


}
