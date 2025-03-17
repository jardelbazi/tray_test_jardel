<?php

namespace App\Repositories\User;

use App\DTOs\User\UserFilterDTO;
use App\Interpreters\User\UserFilterInterpreter;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class UserRepository
 *
 * Repositório responsável por interagir com o modelo de dados do usuário.
 * Contém métodos para criar, atualizar, buscar usuários e aplicar filtros.
 *
 * @package App\Repositories\User
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * Construtor do repositório de usuários.
     *
     * @param UserFilterInterpreter $filterInterpreter O interpretador de filtros utilizado
     * para aplicar filtros ao consultar usuários.
     */
    public function __construct(
        private UserFilterInterpreter $filterInterpreter,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function create(User $user): User
    {
        $user->save();
        return $user->fresh();
    }

    /**
     * {@inheritDoc}
     */
    public function getByGoogleId(string $gooleId): ?User
    {
        return User::where('google_id', $gooleId)->first();
    }

    /**
     * {@inheritDoc}
     */
    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function getAll(?UserFilterDTO $userFilterDTO = null, int $perPage = 50): LengthAwarePaginator
    {
        $query = User::query();

        if ($userFilterDTO) {
            $filters = $this->filterInterpreter->interpret($userFilterDTO);
            $query = $this->filterInterpreter->applyFilters($query, $filters);
        }

        return $query->paginate($perPage);
    }
}
