<?php

namespace NotificationChannels\SMSApi;

use Illuminate\Support\ServiceProvider;

class SMSApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(SMSApiChannel::class)
            ->needs(SMSApi::class)
            ->give(function () {
                $config = config('services.smsapi');

                return new SMSApi(
                    $config['token']
                );
            });

    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
