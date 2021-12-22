<?php

namespace App\Http\Services;

use App\Models\SocialAccount;
use App\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser, $service)
    {

        $account = SocialAccount::whereProvider($service)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if(!$account) {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $service
            ]);
        }

        if ($account->user) {
            return $account->user;
        }

        $user = User::whereEmail($providerUser->getEmail())->first();

        if (!$user) {
            $user = AuthService::register($providerUser->getEmail(), $providerUser->getName(), '', '', '');
            //hardcode bug?
            $user['user']->AssignRole('user');
            //
        }

        $account->user()->associate($user);
        $account->save();

        return $user;

    }
}
