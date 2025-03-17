<?php

namespace App\DTOs\User;

use App\DTOs\FilterDTO;

/**
 * Class UserFilterDTO
 *
 * Representa um Data Transfer Object (DTO) utilizado para transferir parâmetros de filtro
 * relacionados ao usuário. Este DTO é usado para filtrar a busca de usuários
 * com base nos critérios fornecidos.
 *
 * @package App\DTOs\User
 */
class UserFilterDTO extends FilterDTO
{
    /**
     * UserFilterDTO constructor.
     *
     * @param string|null $name O nome do usuário para filtrar (opcional).
     * @param string|null $cpf O CPF do usuário para filtrar (opcional).
     */
    public function __construct(
        public ?string $name = null,
        public ?string $cpf = null,
    ) {}
}
