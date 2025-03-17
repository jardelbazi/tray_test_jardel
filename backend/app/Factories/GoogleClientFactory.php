<?php

namespace App\Factories;

use App\Exceptions\GoogleClientException;
use Exception;
use Google\Client as GoogleClient;
use Google\Service\Oauth2 as GoogleServiceOauth2;

/**
 * Class GoogleClientFactory
 *
 * Fábrica para instanciar e configurar um cliente do Google.
 * Essa classe encapsula a lógica de criação do cliente do Google,
 * garantindo que as credenciais estejam configuradas corretamente.
 *
 * @package App\Factories
 */
class GoogleClientFactory
{
    /**
     * Cria e retorna uma instância do GoogleClient configurada.
     *
     * @throws GoogleClientException Se as credenciais do Google estiverem ausentes.
     * @throws Exception Se houver falha ao criar o cliente do Google.
     *
     * @return GoogleClient Cliente do Google configurado.
     */
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
