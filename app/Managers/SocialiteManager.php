<?php

namespace App\Managers;

use App\Providers\Socialite\OfficeProvider;
use Laravel\Socialite\SocialiteManager as BaseSocialiteManager;
use Laravel\Socialite\Two\AbstractProvider;

class SocialiteManager extends BaseSocialiteManager
{
    /**
     * Create an instance of the specified driver.
     *
     * @return AbstractProvider
     */
    protected function createOfficeDriver()
    {
        $config = config('services.office');

        return $this->buildProvider(
            OfficeProvider::class,
            $config
        );
    }
}
