<?php

namespace App\DTOs\GoogleUser;

/**
 * Class GoogleUserDTO
 *
 * Representa um Data Transfer Object (DTO) que contém as informações de um usuário do Google.
 * Este DTO é utilizado para transferir os dados do usuário, para outras camadas do sistema.
 *
 * @package App\DTOs\GoogleUser
 */
class GoogleUserDTO
{
    /**
     * GoogleUserDTO constructor.
     *
     * @param string $googleId O ID do usuário no Google.
     * @param string $name O nome do usuário.
     * @param string $email O e-mail do usuário.
     * @param string $token O token de autenticação do usuário.
     */
    public function __construct(
        public string $googleId,
        public string $name,
        public string $email,
        public string $token
    ) {}
}
