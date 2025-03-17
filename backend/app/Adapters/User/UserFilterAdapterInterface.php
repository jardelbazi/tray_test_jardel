<?php

namespace App\Adapters\User;

use App\DTOs\User\UserFilterDTO;
use Illuminate\Http\Request;

/**
 * Interface UserFilterAdapterInterface
 *
 * Define o contrato para a adaptação de filtros de usuário de uma requisição para um UserFilterDTO.
 * Este adaptador transforma os parâmetros de filtro recebidos de um request em um DTO que pode ser
 * utilizado na camada de serviço ou repositório para buscar os dados de usuários.
 *
 * @package App\Adapters\User
 */
interface UserFilterAdapterInterface
{
    /**
     * Converte os parâmetros de filtro de uma requisição em um UserFilterDTO.
     *
     * @param Request $request O request contendo os parâmetros de filtro para buscar usuários.
     *
     * @return UserFilterDTO O DTO com os filtros de usuário extraídos da requisição.
     */
    public function fromRequest(Request $request): UserFilterDTO;
}
