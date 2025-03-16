<?php

namespace App\Adapters\GoogleUser;

use App\DTOs\GoogleUser\GoogleUserDTO;
use Google\Service\Oauth2\Userinfo;

interface GoogleUserAdapterInterface
{
    public function userInfoToDTO(Userinfo $googleUser, array $token): GoogleUserDTO;
}
