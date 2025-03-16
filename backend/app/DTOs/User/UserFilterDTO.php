<?php

namespace App\DTOs\User;

use App\DTOs\FilterDTO;

class UserFilterDTO extends FilterDTO
{
    public function __construct(
        public ?string $name = null,
        public ?string $cpf = null,
    ) {}
}
