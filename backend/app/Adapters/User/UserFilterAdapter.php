<?php

namespace App\Adapters\User;

use App\DTOs\User\UserFilterDTO;
use Illuminate\Http\Request;

/**
 * Class UserFilterAdapter
 *
 * Implementa a interface UserFilterAdapterInterface, responsável por adaptar os parâmetros
 * de filtro de usuário recebidos em uma requisição para um DTO de filtro (UserFilterDTO).
 * Esse adaptador facilita a conversão de dados de requisições para um formato utilizável em
 * processos de busca e filtragem de usuários.
 *
 * @package App\Adapters\User
 */
class UserFilterAdapter implements UserFilterAdapterInterface
{
    /**
     * {@inheritDoc}
     */
    public function fromRequest(Request $request): UserFilterDTO
    {
        return new UserFilterDTO(
            name: $request->name,
            cpf: $request->cpf,
            googleId: $request->googleId,
        );
    }
}
