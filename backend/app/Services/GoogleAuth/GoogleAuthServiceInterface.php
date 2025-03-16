<?php

namespace App\Services\GoogleAuth;

use App\DTOs\GoogleUser\GoogleUserDTO;

interface GoogleAuthServiceInterface
{
    public function getAuthUrl(): string;

    public function fetchGoogleUser(string $code): GoogleUserDTO;
}
