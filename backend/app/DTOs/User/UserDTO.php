<?php

namespace App\DTOs\User;

use App\DTOs\BaseDTO;

class UserDTO extends BaseDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $birthDate = null,
        public ?string $cpf = null,
        public ?string $googleId = null,
        public ?string $googleToken = null,
    ) {}
}
