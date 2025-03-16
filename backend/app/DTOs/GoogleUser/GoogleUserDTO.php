<?php

namespace App\DTOs\GoogleUser;

class GoogleUserDTO
{
    public function __construct(
        public string $googleId,
        public string $name,
        public string $email,
        public string $token
    ) {}
}
