<?php

namespace App\Repositories\User;

use App\DTOs\User\UserFilterDTO;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface UserRepositoryInterface
 *
 * Interface que define os métodos necessários para interação com os dados do usuário.
 * Implementada pelo repositório de usuários para garantir uma estrutura comum
 * de operações relacionadas a usuários, como criação, atualização, e recuperação de dados.
 *
 * @package App\Repositories\User
 */
interface UserRepositoryInterface
{
    /**
     * Cria um novo usuário no banco de dados.
     *
     * @param User $user O modelo de usuário a ser salvo.
     * @return User O usuário recém-criado.
     */
    public function create(User $user): User;

    /**
     * Recupera um usuário pelo seu ID do Google.
     *
     * @param string $gooleId O ID do Google do usuário.
     * @return User|null O usuário encontrado ou null caso não exista.
     */
    public function getByGoogleId(string $gooleId): ?User;

    /**
     * Atualiza os dados de um usuário no banco de dados.
     *
     * @param User $user O modelo de usuário a ser atualizado.
     * @param array $data Os dados a serem atualizados.
     * @return User O usuário atualizado.
     */
    public function update(User $user, array $data): User;

    /**
     * Recupera todos os usuários, com possibilidade de aplicar filtros.
     *
     * @param UserFilterDTO|null $userFilterDTO O DTO de filtro a ser aplicado.
     * @param int $perPage O número de usuários por página (padrão 50).
     * @return LengthAwarePaginator A lista de usuários paginada.
     */
    public function getAll(?UserFilterDTO $userFilterDTO = null, int $perPage = 50): LengthAwarePaginator;
}
