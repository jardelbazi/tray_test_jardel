<?php

namespace App\DTOs\User;

use App\DTOs\BaseDTO;

/**
 * Class UserDTO
 *
 * Representa um Data Transfer Object (DTO) para transferir dados de um usuário.
 * Este DTO é utilizado para transferir informações entre diferentes camadas do sistema.
 *
 * @package App\DTOs\User
 */
class UserDTO
{
    /**
     * UserDTO constructor.
     *
     * @param string $name O nome do usuário.
     * @param string $email O e-mail do usuário.
     * @param string|null $birthDate A data de nascimento do usuário (opcional).
     * @param string|null $cpf O CPF do usuário (opcional).
     * @param string|null $googleId O ID do usuário no Google (opcional).
     * @param string|null $googleToken O token de autenticação do usuário no Google (opcional).
     */
    public function __construct(
        public string $name,
        public string $email,
        public ?string $birthDate = null,
        public ?string $cpf = null,
        public ?string $googleId = null,
        public ?string $googleToken = null,
    ) {}
}
