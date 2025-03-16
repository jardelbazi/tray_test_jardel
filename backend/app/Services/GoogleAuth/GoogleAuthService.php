<?php

namespace App\Services\GoogleAuth;

use App\Adapters\GoogleUser\GoogleUserAdapterInterface;
use App\DTOs\GoogleUser\GoogleUserDTO;
use Google\Client as GoogleClient;
use Google\Service\Oauth2 as GoogleServiceOauth2;
use App\Services\GoogleAuth\GoogleAuthServiceInterface;
use Google\Service\Oauth2\Userinfo;

class GoogleAuthService implements GoogleAuthServiceInterface
{
    public function __construct(
        private GoogleClient $client,
        private GoogleUserAdapterInterface $adapter
    ) {}

    public function getAuthUrl(): string
    {
        return $this->client->createAuthUrl();
    }

    public function fetchGoogleUser(string $code): GoogleUserDTO
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);
        $this->client->setAccessToken($token);

        $googleUser = $this->getGoogleUser();

        return $this->adapter->userInfoToDTO($googleUser, $token);
    }

    private function getGoogleUser(): UserInfo
    {
        $oauth2Service = new GoogleServiceOauth2($this->client);
        return $oauth2Service->userinfo->get();
    }
}
