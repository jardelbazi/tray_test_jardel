<?php

namespace App\Services\User;

use App\DTOs\User\UserFilterDTO;
use App\DTOs\User\UserUpdateDTO;
use App\Http\Requests\UserRequest;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface UserServiceInterface
 *
 * Interface que define os métodos necessários para o serviço de usuários.
 * Esta interface abstrai as operações relacionadas ao gerenciamento de usuários,
 * incluindo criação, atualização e recuperação de dados de usuários, além de
 * integração com autenticação do Google.
 *
 * @package App\Services\User
 */
interface UserServiceInterface
{
    /**
     * Recupera a URL de autenticação do Google.
     *
     * Gera a URL de autenticação para permitir que o usuário se autentique com a conta Google.
     *
     * @return string A URL de autenticação do Google.
     */
    public function getGoogleAuthUrl(): string;

    /**
     * Cria um novo usuário a partir do código de autenticação do Google.
     *
     * Após o redirecionamento do usuário e obtenção do código de autorização, este método é
     * responsável por criar o usuário e retornar um DTO com as informações do usuário atualizado.
     *
     * @param string $code O código de autorização obtido após o login do usuário.
     * @return UserUpdateDTO O DTO com as informações do usuário atualizado.
     */
    public function create(string $code): UserUpdateDTO;

    /**
     * Atualiza as informações de um usuário existente.
     *
     * Este método é responsável por atualizar os dados de um usuário com base na requisição
     * recebida, retornando um DTO com as informações do usuário atualizado.
     *
     * @param UserRequest $userRequest O objeto da requisição contendo os dados do usuário.
     * @return UserUpdateDTO O DTO com as informações do usuário atualizado.
     */
    public function update(UserRequest $userRequest): UserUpdateDTO;

    /**
     * Recupera todos os usuários, com possibilidade de aplicar filtros.
     *
     * Retorna uma lista paginada de usuários, podendo aplicar filtros através do DTO de filtro.
     *
     * @param UserFilterDTO|null $userFilterDTO O DTO de filtro a ser aplicado, caso fornecido.
     * @return LengthAwarePaginator A lista paginada de usuários.
     */
    public function getAll(?UserFilterDTO $userFilterDTO = null): LengthAwarePaginator;

    /**
     * Recupera um único usuário com base nos critérios fornecidos.
     *
     * Este método recebe um DTO de filtro contendo os critérios de busca
     * e retorna um DTO atualizado do usuário correspondente.
     *
     * @param UserFilterDTO $userFilterDTO Objeto contendo os critérios de filtro do usuário.
     * @return UserUpdateDTO Retorna os dados atualizados do usuário encontrado.
     */
    public function getOne(UserFilterDTO $userFilterDTO): UserUpdateDTO;
}
