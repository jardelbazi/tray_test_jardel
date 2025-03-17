<?php

namespace App\Adapters\GoogleUser;

use App\DTOs\GoogleUser\GoogleUserDTO;
use Google\Service\Oauth2\Userinfo;

/**
 * Class GoogleUserAdapter
 *
 * Implementação do GoogleUserAdapterInterface, responsável por adaptar as informações de usuário do Google
 * para o formato de um DTO de GoogleUser.
 *
 * @package App\Adapters\GoogleUser
 */
class GoogleUserAdapter implements GoogleUserAdapterInterface
{
    /**
     * {@inheritDoc}
     */
    public function userInfoToDTO(Userinfo $googleUser, array $token): GoogleUserDTO
    {
        return new GoogleUserDTO(
            googleId: $googleUser->id,
            name: $googleUser->name,
            email: $googleUser->email,
            token: json_encode($token),
        );
    }
}
