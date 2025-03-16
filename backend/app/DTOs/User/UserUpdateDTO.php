<?php

namespace App\DTOs\User;

class UserUpdateDTO extends UserDTO
{
    public function __construct(
        public string $id,
        string $name,
        string $email,
        ?string $birthDate = null,
        ?string $cpf = null,
        ?string $googleId = null,
        ?string $googleToken = null,
    ) {
        parent::__construct(
            name: $name,
            email: $email,
            birthDate: $birthDate,
            cpf: $cpf,
            googleId: $googleId,
            googleToken: $googleToken,
        );
    }
}
