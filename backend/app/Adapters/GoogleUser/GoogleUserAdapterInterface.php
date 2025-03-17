<?php

namespace App\Adapters\GoogleUser;

use App\DTOs\GoogleUser\GoogleUserDTO;
use Google\Service\Oauth2\Userinfo;

/**
 * Interface GoogleUserAdapterInterface
 *
 * Define o contrato para adaptação das informações de usuário do Google para um DTO.
 *
 * @package App\Adapters\GoogleUser
 */
interface GoogleUserAdapterInterface
{
    /**
     * Converte as informações de um usuário do Google em um DTO de GoogleUser.
     *
     * @param Userinfo $googleUser Informações do usuário retornadas pela API do Google.
     * @param array $token O token de autenticação do usuário.
     *
     * @return GoogleUserDTO O DTO com as informações do usuário do Google.
     */
    public function userInfoToDTO(Userinfo $googleUser, array $token): GoogleUserDTO;
}
