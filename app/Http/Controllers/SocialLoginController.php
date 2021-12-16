<?php

namespace App\Http\Controllers;


use App\Http\Services\SocialAccountService;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['social', 'web']);
    }

    public function redirect($service)
    {
        //http://localhost:8000/api/login/facebook
        return Socialite::driver($service)->redirect();
    }

    public function callback($service, SocialAccountService $SocialAccountService)
    {

        try {
            $user = $SocialAccountService->createOrGetUser(Socialite::driver($service)->stateless()->user(), $service);

        } catch (\Exception $e) {
            return redirect(env('CLIENT_BASE_URL') . '/social-callback?error=Unable to login using ' . $service . '. Please try again' . '&origin=login');
        }

        $token = $user->createToken('name')->accessToken;

//        if ((env('RETRIEVE_UNVERIFIED_SOCIAL_EMAIL') == 0) && ($service != 'google')) {
//            $email = $serviceUser->getId() . '@' . $service . '.local';
//        } else {
//            $email = $serviceUser->getEmail();
//        }

        return redirect(env('CLIENT_BASE_URL') . '/social-callback?token=' . $token);
    }
}
