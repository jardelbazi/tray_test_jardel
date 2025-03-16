<?php

namespace App\Factories;

use App\Exceptions\GoogleClientException;
use Exception;
use Google\Client as GoogleClient;
use Google\Service\Oauth2 as GoogleServiceOauth2;

class GoogleClientFactory
{
    public static function create(): GoogleClient
    {
        try {
            $client = new GoogleClient();

            $clientId = config('services.google.client_id');
            $clientSecret = config('services.google.client_secret');
            $redirectUri = config('services.google.redirect');

            if (!$clientId || !$clientSecret || !$redirectUri) {
                throw new GoogleClientException('Credenciais da API do Google ausentes na configuração.');
            }

            $client->setClientId($clientId);
            $client->setClientSecret($clientSecret);
            $client->setRedirectUri($redirectUri);
            $client->addScope(GoogleServiceOauth2::USERINFO_EMAIL);
            $client->addScope(GoogleServiceOauth2::USERINFO_PROFILE);

            return $client;
        } catch (GoogleClientException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('Falha ao criar o Google Client. Verifique a configuração e tente novamente.');
        }
    }
}
