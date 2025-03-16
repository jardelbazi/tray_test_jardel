<?php

namespace App\Services\GoogleAuth;

use App\Adapters\GoogleUser\GoogleUserAdapterInterface;
use App\DTOs\GoogleUser\GoogleUserDTO;
use App\Exceptions\GoogleAuthException;
use Google\Client as GoogleClient;
use Google\Service\Oauth2 as GoogleServiceOauth2;
use App\Services\GoogleAuth\GoogleAuthServiceInterface;
use Google\Exception as GoogleException;
use Google\Service\Oauth2\Userinfo;

class GoogleAuthService implements GoogleAuthServiceInterface
{
    public function __construct(
        private GoogleClient $client,
        private GoogleUserAdapterInterface $adapter
    ) {}

    public function getAuthUrl(): string
    {
        try {
            return $this->client->createAuthUrl();
        } catch (GoogleException $e) {
            throw new GoogleAuthException('Erro ao gerar URL de autenticação do Google', 0, $e);
        }
    }

    public function fetchGoogleUser(string $code): GoogleUserDTO
    {
        try {
            $token = $this->client->fetchAccessTokenWithAuthCode($code);

            if (isset($token['error'])) {
                throw new GoogleAuthException('Erro ao obter token do Google: ' . $token['error']);
            }

            $this->client->setAccessToken($token);

            $googleUser = $this->getGoogleUser();

            return $this->adapter->userInfoToDTO($googleUser, $token);
        } catch (GoogleException $e) {
            throw new GoogleAuthException('Erro ao buscar usuário do Google', 0, $e);
        }
    }

    private function getGoogleUser(): UserInfo
    {
        try {
            $oauth2Service = new GoogleServiceOauth2($this->client);
            return $oauth2Service->userinfo->get();
        } catch (GoogleException $e) {
            throw new GoogleAuthException('Erro ao obter informações do usuário do Google', 0, $e);
        }
    }
}
