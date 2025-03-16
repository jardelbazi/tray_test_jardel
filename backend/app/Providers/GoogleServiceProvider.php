<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Google\Client as GoogleClient;
use App\Factories\GoogleClientFactory;

class GoogleServiceProvider extends ServiceProvider
{
    public $bindings = [
        \App\Services\GoogleAuth\GoogleAuthServiceInterface::class => \App\Services\GoogleAuth\GoogleAuthService::class,
        \App\Adapters\GoogleUser\GoogleUserAdapterInterface::class => \App\Adapters\GoogleUser\GoogleUserAdapter::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(GoogleClient::class, function () {
            return GoogleClientFactory::create();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
