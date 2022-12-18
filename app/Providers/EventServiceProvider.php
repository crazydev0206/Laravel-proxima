<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class=>[
            'SocialiteProviders\\Instagram\\InstagramExtendSocialite@handle',
            'SocialiteProviders\Facebook\FacebookExtendSocialite@handle',
            'SocialiteProviders\LinkedIn\LinkedInExtendSocialite@handle',
            'SocialiteProviders\Google\GoogleExtendSocialite@handle',
            // 'SocialiteProviders\Snapchat\SnapchatExtendSocialite@handle',
            // 'SocialiteProviders\TikTok\TikTokExtendSocialite@handle',
        ]   
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
