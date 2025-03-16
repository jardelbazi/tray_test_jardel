<?php

namespace App\Factories;

use Google\Client as GoogleClient;
use Google\Service\Oauth2 as GoogleServiceOauth2;

class GoogleClientFactory
{
    public static function create(): GoogleClient
    {
        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->addScope(GoogleServiceOauth2::USERINFO_EMAIL);
        $client->addScope(GoogleServiceOauth2::USERINFO_PROFILE);

        return $client;
    }
}
