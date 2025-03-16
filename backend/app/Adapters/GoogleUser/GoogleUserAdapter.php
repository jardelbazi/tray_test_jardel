<?php

namespace App\Adapters\GoogleUser;

use App\DTOs\GoogleUser\GoogleUserDTO;
use Google\Service\Oauth2\Userinfo;

class GoogleUserAdapter implements GoogleUserAdapterInterface
{
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
