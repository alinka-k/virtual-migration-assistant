<?php

namespace App\Repositories;

use App\Events\Auth\SocialRegistered;
use App\Models\SocialAccount;
use App\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountRepository
{
    public function createOrGetUser(ProviderUser $providerUser, string $type)
    {
        $account = SocialAccount::whereProvider($type)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        }

        $account = new SocialAccount([
            'provider_user_id' => $providerUser->getId(),
            'provider' => $type
        ]);
        $user = User::whereEmail($providerUser->getEmail())->first();
        if (!$user) {
            $user = new User();
            $user->email = $providerUser->getEmail();
            $user->password = bcrypt(rand(1, 10000));
            $user->first_name = $providerUser->getName();
            $user->save();
            event(new SocialRegistered($user));
        }
        $account->user()->associate($user);
        $account->save();

        return $user;
    }
}
