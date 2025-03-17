<?php

namespace App\DTOs\User;

/**
 * Class UserUpdateDTO
 *
 * Representa um Data Transfer Object (DTO) utilizado para transferir os dados de um usuário
 * para atualização. Este DTO é uma extensão do `UserDTO`, adicionando o campo `id`.
 *
 * @package App\DTOs\User
 */
class UserUpdateDTO extends UserDTO
{
    /**
     * UserUpdateDTO constructor.
     *
     * @param string $id O ID do usuário que será atualizado.
     * {@inheritDoc}
     */
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
