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

/**
 * Class GoogleAuthService
 *
 * Serviço responsável pela autenticação com o Google.
 * Contém métodos para gerar a URL de autenticação e buscar as informações do usuário
 * autenticado através do código de autorização obtido após o login.
 *
 * @package App\Services\GoogleAuth
 */
class GoogleAuthService implements GoogleAuthServiceInterface
{
    /**
     * Construtor do serviço de autenticação do Google.
     *
     * @param GoogleClient $client O cliente da API do Google utilizado para interagir com os serviços do Google.
     * @param GoogleUserAdapterInterface $adapter O adaptador que converte as informações do usuário do Google para o DTO.
     */
    public function __construct(
        private GoogleClient $client,
        private GoogleUserAdapterInterface $adapter
    ) {}

    /**
     * {@inheritDoc}
     * @throws GoogleAuthException Se houver um erro ao gerar a URL de autenticação.
     */
    public function getAuthUrl(): string
    {
        try {
            return $this->client->createAuthUrl();
        } catch (GoogleException $e) {
            throw new GoogleAuthException('Erro ao gerar URL de autenticação do Google', 0, $e);
        }
    }

    /**
     * {@inheritDoc}
     * @throws GoogleAuthException Se houver um erro ao buscar o token ou as informações do usuário.
     */
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

    /**
     * {@inheritDoc}
     * @throws GoogleAuthException Se houver um erro ao buscar as informações do usuário do Google.
     */
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
